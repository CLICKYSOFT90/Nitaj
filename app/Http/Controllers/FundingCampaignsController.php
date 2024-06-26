<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FundingCampaigns;
use App\Models\FundingPhase;
use App\Models\Notifications;
use App\Models\Project;
use App\Models\RecentActivities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FundingCampaignsController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FundingCampaigns::selectRaw('funding_campaigns.id as fc_id,
                funding_campaigns.status as fc_status,
                funding_campaigns.created_at as fc_created_at,
                funding_campaigns.ending_period as fc_ending_period,
                projects.id as p_id,
                projects.project_name_en as p_name')
                ->join('projects', 'funding_campaigns.project_id','=', 'projects.id' )
                ->orderByDesc('funding_campaigns.created_at');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('project_name', function($row){
                    return $row->p_name;
                })
                ->addColumn('created_at', function($row){
                    return date('d-M-Y', strtotime($row->fc_created_at));
                })
                ->addColumn('ending_period', function($row){
                    return date('d-M-Y', strtotime($row->fc_ending_period));
                })
                ->addColumn('amount_required', function($row){
                    return getProjectTotalInvestments($row->p_id);
                })
                ->addColumn('status', function($row){
                    $class = $row->fc_status == 1 ? 'new-campaign-button-active' : 'new-campaign-button-view';
                    $status = $row->fc_status == 1 ? 'Active' : 'Not Active';
                    $statuschange = $row->fc_status == 1 ? 0 : 1;
                    $div = '<div class="group-buttons categories-progress-view text-left">
                            <a href="javascript:;" onclick="changeStatus('.$row->fc_id.','.$statuschange.')" class="'.$class.'">'.$status.'</a>
                            </div>';

                    return $div;
                })
//                ->addColumn('action', function($row){
//                    $btn = '<div class="group-buttons categories-progress-view">
//                                <a href="'.route('admin.funding-campaign.edit', $row->fc_id).'" class="new-campaign-button-view">Edit</a>
//                              </div>';
//
//                    return $btn;
//                })
                ->rawColumns(['status', 'created_at'])
                ->make(true);
        }
    }

    public function fundingCampaignList(){
        return view('admin.funding-campaign.funding-campaign');
    }

    public function addFundingCampaign()
    {
        $projects = Project::all();
        return view('admin.funding-campaign.addCampaign')->with('projects', $projects);
    }

    public function postAddFundingCampaign(Request $request)
    {
        $data = $request->all();
        $validate_data = [
            'proj_name' => 'required',
            'campaign_type' => 'required',
            'start_period' => 'required',
            'ending_period' => 'required|after:start_period',
            'amount_req' => 'required',

//            'min_amount' => 'required',
//            'phase_start_period' => 'required',
//            'phase_ending_period' => 'required',
        ];

        $validator = Validator::make($request->all(),$validate_data);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else {
            $campaign_exist = FundingCampaigns::whereProjectId($request->proj_name)->whereStatus(1)->orderBy('created_at', 'DESC')->first();
            if($campaign_exist && $campaign_exist->ending_period > date('Y-m-d')){
                Session::flash('alert', "Campaign for this project has not ended.");
                return redirect()->back();
            }
//        dd($data);

            $campaign = new FundingCampaigns();
            $campaign->project_id = $request->proj_name;
            $campaign->campaign_type = $request->campaign_type;
            $campaign->starting_period = date('Y-m-d', strtotime($request->start_period));
            $campaign->ending_period = date('Y-m-d', strtotime($request->ending_period));
            $campaign->amount_required = $request->amount_req;
            $campaign->funding_phases = $request->funding_phases;
            $campaign->status = 0;
            $campaign->save();

//            $campaign_phase = new FundingPhase();
//            $campaign_phase->funding_campaign_id = $campaign->id;
//            $campaign_phase->min_investment = $request->min_amount;
//            $campaign_phase->phase_start = date('Y-m-d', strtotime($request->start_period));
//            $campaign_phase->phase_end = date('Y-m-d', strtotime($request->phase_ending_period));
//            $campaign_phase->save();

            $data[] = [
                'to' => 0,
                'subject' => 'New Project',
                'purpose' => 'New Project Created',
                'desc' => 'Admin has created a new project "'.$request->proj_name.'"',
                'type'=> 'funding_campaign'
            ];
            $this->notification($data);

            //Adding in recent activity
            $activity = [
                'user_id' => 1,
                'title' => 'Vote Campaign',
                'project_id' => $request->proj_name,
                'vote_campaign_id' => $campaign->id,
                'type' => 'vote_campaign',
            ];
            RecentActivities::insert($activity);

            Session::flash('success', "Campaign Added Successfully!");
            return redirect()->back();
        }
    }
    public function editFundingCampaign($campaign_id)
    {
        $campaign = FundingCampaigns::find($campaign_id);
        $projects = Project::all();
        return view('admin.funding-campaign.editCampaign')->with('projects', $projects)->with('campaign', $campaign);
    }
    public function postEditFundingCampaign(Request $request, $campaign_id)
    {
        $validate_data = [
            'proj_name' => 'required',
            'campaign_type' => 'required',
            'start_period' => 'required',
            'ending_period' => 'required',
            'amount_req' => 'required',
            'funding_phases' => 'required',

            'min_amount' => 'required',
            'phase_start_period' => 'required',
            'phase_ending_period' => 'required',
        ];

        $validator = Validator::make($request->all(),$validate_data);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else {
            $campaign = FundingCampaigns::find($campaign_id);
            $campaign->project_id = $request->proj_name;
            $campaign->campaign_type = $request->campaign_type;
            $campaign->starting_period = $request->start_period;
            $campaign->ending_period = $request->ending_period;
            $campaign->amount_required = $request->amount_req;
            $campaign->funding_phases = $request->funding_phases;
            $campaign->save();

            $campaign_phase = FundingPhase::where('funding_campaign_id', $campaign_id)->first();
            $campaign_phase->funding_campaign_id = $campaign->id;
            $campaign_phase->min_investment = $request->min_amount;
            $campaign_phase->phase_start = $request->phase_start_period;
            $campaign_phase->phase_end = $request->phase_ending_period;
            $campaign_phase->save();

            Session::flash('success', "Campaign Updated Successfully!");
            return redirect()->back();
        }
    }
    public function changeStatusFundingCampaign(Request $request)
    {
        $campaign = FundingCampaigns::find($request->id);
        $campaign->status = $request->status;
        $campaign->updated_at = Carbon::now();
        $campaign->save();
        return response()->json([
            'status' => true,
            'error' => "Status Changed Successfully",
        ], 200);
    }

    public function getCategory(Request $request){
        $option = '';
        $categories = Project::select('*')->addSelect('projects.category_id as c_id, categories.name_en as c_name,
        project_fundings.funding_required as pf_funding_required, project_fundings.min_investment as pf_min_investment')
                        ->leftjoin('categories', 'projects.category_id', '=', 'categories.id')
                        ->leftjoin('funding_campaigns', 'projects.id', '=', 'funding_campaigns.project_id')
                        ->leftjoin('project_fundings', 'projects.id', '=', 'project_fundings.project_id')
                        ->where('projects.id', $request->project_id)
                        ->first();
        return response()->json([
            'status'=> true,
            'data'=> $categories,
        ]);
    }
}
