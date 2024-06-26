<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\InvestorInvestments;
use App\Models\Project;
use App\Models\Settings;
use App\Models\SharesLogs;
use App\Models\SharesPurchaseRequests;
use App\Models\Transactions;
use App\Models\UserWallets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class SharesApprovalRequestsController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SharesPurchaseRequests::select('*')->orderBy('created_at', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    $user = $this->getUser($row->user_id);
                    return '<a class="color-green" href="' . route('admin.investor.view', $row->user_id) . '">' . $user->fname . ' ' . $user->lname . '</a>';
                })
                ->addColumn('project', function ($row) {
                    $project = $this->getProject($row->project_id);
                    return ucfirst($project->project_name_en);
                })
                ->addColumn('no_of_shares', function ($row) {
                    return $row->no_of_shares;
                })
                ->addColumn('otp_verified', function ($row) {
                    if ($row->otp_verified == 1) {
                        $status_div = '<a href="javascript:;" class="new-campaign-button-active">Verified</a>';
                    } else {
                        $status_div = '<a href="" class="new-campaign-button-view">Not Verified</a>';
                    }
                    $btn = '<div class="group-buttons categories-progress-view">
                                ' . $status_div . '
                              </div>';

                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="group-buttons categories-progress-view">
                                <a href="' . route("admin.approval.requests.statusChange", [$row->id, 'approved']) . '" class="new-campaign-button-active">Approve</a>
                                <a href="' . route("admin.approval.requests.statusChange", [$row->id, 'reject']) . '" class="new-campaign-button-view">Reject</a>
                              </div>';
                    return $btn;
                })
                ->rawColumns(['user', 'project', 'no_of_shares', 'otp_verified', 'action'])
                ->make(true);
        }
    }

    public function approvalList()
    {
        return view('admin.shares-approval-requests.approval-requests');
    }

    public function approvalStatusChange($id, $status)
    {
        if ($status == 'approved') {
            $settings = Settings::first();
            $share_purchase = SharesPurchaseRequests::findorfail($id);

            $investor_investment_exist = InvestorInvestments::whereUserId($share_purchase->user_id)
                ->whereProjectId($share_purchase->project_id)
                ->first();
            $investment_exist = InvestorInvestments::select('*')
                ->selectRaw('sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares, project_fundings.no_of_shares as project_total_shares,
                project_fundings.no_of_shares - sum(investor_investments.no_of_shares - investor_investments.sold_shares) as remaining_shares')
                ->join('project_fundings', 'project_fundings.project_id', 'investor_investments.project_id')
                ->where('investor_investments.project_id',$share_purchase->project_id)
                ->get();

            if(!is_null($investment_exist[0]->remaining_shares) && $share_purchase->no_of_shares > $investment_exist[0]->remaining_shares){
                Session::flash('alert', "Cannot approve this request as the requested shares approval exceeds the remaining shares which is ".$investment_exist[0]->remaining_shares);
                return redirect()->back();
            }

            $project = Project::findorfail($share_purchase->project_id);
            $project_total_shares = $project->projectFunding->no_of_shares;
            if($investment_exist[0]->total_shares == $project_total_shares){
                Session::flash('alert', "All Shares has been sold.");
                return redirect()->back();
            }
            $share_amount = $share_purchase->no_of_shares * $project->ProjectFunding->price_per_share;
            $amount_with_fee = $share_amount + $project->projectFunding->subscription_fee + ($settings->vat / 100 * $project->projectFunding->subscription_fee);
            if (empty($investor_investment_exist)) {
                $investor_investment = new InvestorInvestments();
                $investor_investment->user_id = $share_purchase->user_id;
                $investor_investment->project_id = $share_purchase->project_id;
                $investor_investment->amount_invested = $share_amount;
                $investor_investment->no_of_shares = $share_purchase->no_of_shares;
                $investor_investment->status = 1;
                $investor_investment->admin_approved = 1;
                $investor_investment->save();

            } else {
                $investor_investment_exist->no_of_shares = $investor_investment_exist->no_of_shares + $share_purchase->no_of_shares;
                $investor_investment_exist->amount_invested = $investor_investment_exist->amount_invested + $share_amount;
                $investor_investment_exist->save();
            }

            $share_logs = new SharesLogs();
            $share_logs->seller_user_id = 1;
            $share_logs->buyer_user_id = $share_purchase->user_id;
            $share_logs->project_id = $share_purchase->project_id;
            $share_logs->no_of_shares = $share_purchase->no_of_shares;
            $share_logs->amount = $amount_with_fee;
            $share_logs->status = 1;
            $share_logs->save();
            $share_purchase->delete();
            $activity = [
                'user_id' => $share_purchase->user_id,
                'title' => 'Share Purchased',
                'project_id' => $share_purchase->project_id,
                'type' => 'share_purchased'
            ];
            recentActivity($activity);

            // Logging in transactions Table
            $transactions = new Transactions();
            $transactions->transaction_type = 'investments';
            $transactions->user_id = $share_purchase->user_id;
            $transactions->project_id = $share_purchase->project_id;
            $transactions->amount = $share_amount;
            $transactions->save();

            $user_wallet = UserWallets::whereuser_id($share_purchase->user_id)->first();
            $user_wallet->deducted_amount = $user_wallet->deducted_amount + $amount_with_fee;
            $user_wallet->save();
            Session::flash('success', "Request Approved!");
            return redirect()->back();
        } else {
            $share_purchase = SharesPurchaseRequests::find($id)->delete();
            Session::flash('success', "Request Rejected!");
            return redirect()->back();
        }
    }
}
