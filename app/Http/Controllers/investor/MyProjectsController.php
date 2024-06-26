<?php

namespace App\Http\Controllers\investor;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\FundingCampaigns;
use App\Models\InvestorInvestments;
use App\Models\Project;
use App\Models\RegistrationStep;
use App\Models\Settings;
use App\Models\SharesLogs;
use App\Models\SharesPurchaseRequests;
use App\Models\User;
use App\Models\UserWallets;
use App\Rules\CheckInvestmentLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MyProjectsController extends BaseController
{

    public function projects()
    {
        $keyword = isset($_GET['search']) ? $_GET['search'] : '';
        if (!$keyword) {
            $projects = FundingCampaigns::whereStatus('1')->get();
//            $projects = Project::has('fundingCampaigns')->with('fundingCampaigns')->pluck('id');
//            dd($projects);
//            $is_exists = \App\Models\InvestorInvestments::select('*')
//                ->addSelect(DB::raw("sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares,
//                                                sum(investor_investments.no_of_shares - investor_investments.sold_shares) * project_fundings.price_per_share as total_amount"))
//                ->join('project_fundings', 'project_fundings.project_id', '=', 'investor_investments.project_id')
//                ->with('projects')
//                ->wherein('investor_investments.project_id', $projects)
//                ->get();
//            dd($is_exists);
            $funded_projects = InvestorInvestments::select('*')
                ->addSelect(DB::raw("sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares"))
                ->with('projects')
                ->groupBy('investor_investments.project_id')
                ->get();
        } else {
            $projects = FundingCampaigns::join('projects', 'projects.id', '=', 'funding_campaigns.project_id')
                ->orwhere('projects.project_name_en', 'like', '%' . $keyword . '%')
                ->orwhere('projects.project_name_ar', 'like', '%' . $keyword . '%')
                ->where('funding_campaigns.status', '1')
                ->get();
            $funded_projects = InvestorInvestments::select('*')
                ->addSelect(DB::raw("sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares"))
                ->join('projects', 'projects.id', '=', 'investor_investments.project_id')
                ->orwhere('projects.project_name_en', 'like', '%' . $keyword . '%')
                ->orwhere('projects.project_name_ar', 'like', '%' . $keyword . '%')
                ->with('projects')
                ->groupBy('investor_investments.project_id')
                ->get();
        }
        return view('investor.my-projects.project')
            ->with('projects', $projects)
            ->with('funded_projects', $funded_projects);
    }

    public function searchProjects(Request $request)
    {
        $projects = FundingCampaigns::wherestatus('1')->get();
        return view('investor.my-projects.project')->with('projects', $projects);
    }

    public function projectsDeatils($project_id)
    {
        $funding_campaign = FundingCampaigns::where(['project_id'=>$project_id, 'status'=>1])->first();
        if (date('Y-m-d', strtotime($funding_campaign->starting_period)) > date('Y-m-d')) {
            return redirect()->back()->with('alert', 'You cannot invest on this project.');
        } else {
            $project = Project::findorfail($project_id);
            $shares_amount = InvestorInvestments::whereproject_id($project_id)->wherestatus(1)->whereAdminApproved(1)->sum('amount_invested');
            $no_of_investors = InvestorInvestments::where('project_id', $project_id)->whereRaw('no_of_shares - sold_shares > 0')->count();
            $remaining_required = $project->projectFunding->funding_required - $shares_amount;
            $remaining_amount = $remaining_required / $project->projectFunding->funding_required;
            $percent = $remaining_amount * 100;
            $percent = round(100 - $percent, 2);
            return view('investor.my-projects.projectDetail')
                ->with('project', $project)
                ->with('funding_campaign', $funding_campaign)
                ->with('percent', $percent)
                ->with('no_of_investors', $no_of_investors);
        }
    }

    public function projectsInvest($project_id)
    {
        $project = Project::findorfail($project_id);
        $purchased_shares = InvestorInvestments::whereproject_id($project_id)
            ->whereStatus(1)
            ->whereAdminApproved(1)
            ->sum(\DB::raw('no_of_shares - sold_shares'));
        if ($purchased_shares >= $project->projectFunding->no_of_shares) {
            Session::flash('alert', "All shares has been purchased");
            return redirect()->back();
        }
        $remaining_shares = $project->projectFunding->no_of_shares - $purchased_shares;
        $funding_campaign = FundingCampaigns::whereproject_id($project_id)->first();
        return view('investor.my-projects.projectInvest')
            ->with('project', $project)
            ->with('funding_campaign', $funding_campaign)
            ->with('remaining_shares', $remaining_shares);
    }

    public function postProjectsInvest(Request $request, $project_id)
    {
        $settings = Settings::first();
        $validate_data = [
            'invest_amount' => ['required'],
            'no_of_share' => 'required',
            'i_acknowledge' => 'required',
            'i_read' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $user_wallet = UserWallets::whereuser_id(auth()->user()->id)->first();
            $project = Project::find($project_id);
            $shares_actual_amount = $project->projectFunding->price_per_share * $request->no_of_share;
            $total_amount = $shares_actual_amount + $project->projectFunding->subscription_fee + ($settings->vat/100 * $project->projectFunding->subscription_fee);
            if ($shares_actual_amount < $project->projectFunding->min_investment) {
                return response()->json([
                    'status' => false,
                    'error' => __('projects.Investment amount should be greater than minimum amount')
                ], 200);
            }
            if ($total_amount > $user_wallet->amount - $user_wallet->deducted_amount + $user_wallet->added_amount) {
                return response()->json([
                    'status' => false,
                    'error' => __('projects.You do not have enough amount in your wallet')
                ], 200);
            }
            if ($request->no_of_share > $project->projectFunding->no_of_shares) {
                return response()->json([
                    'status' => false,
                    'error' => __('projects.You cannot purchased more than total no of shares')
                ], 200);
            }
            if (auth()->user()->type == 0 && $shares_actual_amount > $settings->regular_limit) {
                return response()->json([
                    'status' => false,
                    'error' => __('projects.You cannot invest more than') . ' ' . $settings->regular_limit . ' SAR'
                ], 200);
            }

            $user = User::findorfail(auth()->user()->id);
            $user->otp = 1234;
            $user->save();

            $purchase_request = new SharesPurchaseRequests();
            $purchase_request->user_id = auth()->user()->id;
            $purchase_request->project_id = $project_id;
            $purchase_request->no_of_shares = $request->no_of_share;
            $purchase_request->otp_verified = 0;
            $purchase_request->save();


            return response()->json([
                'status' => true,
                'data' => $purchase_request->id,
            ], 200);
        }
    }

    public function verifyOTP(Request $request)
    {
        $validate_data = [
            'otp1' => 'required',
            'otp2' => 'required',
            'otp3' => 'required',
            'otp4' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $otp = auth()->user()->otp;
            $inputed_otp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;
            if ($otp == $inputed_otp) {
                $investor_invest = SharesPurchaseRequests::find($request->share_id);
                $investor_invest->otp_verified = 1;
                $investor_invest->save();
                return response()->json([
                    'status' => true,
                    'message' => "OTP Verified. Wait for the admin approval",
                    'redirect' => route('investor.projects.detail', $investor_invest->project_id),
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "OTP Not Verified"
                ], 200);
            }
        }
    }
}
