<?php

namespace App\Http\Controllers;

use App\Models\FundingCampaigns;
use App\Models\InvestorInvestments;
use App\Models\Project;
use App\Models\VoteCampaigns;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class VoteCampaignController extends BaseController
{
    public function voteCampaignList()
    {
        return view('admin.vote-campaign.vote-campaign');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = VoteCampaigns::selectRaw('vote_campaigns.id, investor_votes.user_id, vote_campaigns.project_id,
                projects.project_name_en, projects.project_type_en, vote_campaigns.status as vc_status,
                 vote_campaigns.ending_period,vote_campaigns.starting_period, count(user_id) as noi')
                ->leftJoin('projects', 'vote_campaigns.project_id', '=', 'projects.id')
                ->leftJoin('investor_votes', 'investor_votes.vote_campaign_id', '=', 'vote_campaigns.id')
                ->orderBy('vote_campaigns.created_at', 'DESC')
                ->groupBy("vote_campaigns.id")
                ->groupBy("vote_campaigns.project_id")
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('project_name', function ($row) {
                    return $row->project_name_en;
                })
                ->addColumn('project_type', function ($row) {
                    return $row->project_type_en;
                })
                ->addColumn('no_of_investor', function ($row) {
                    return $row->noi;
                })
                ->addColumn('investment_period', function ($row) {
                    $starting_period = $row->starting_period;
                    $ending_period = $row->ending_period;
                    $to = Carbon::parse($starting_period);
                    $end = Carbon::parse($ending_period);
                    $days = $end->diffInDays($to);
                    return $days . ' Days';
                })
                ->addColumn('ending_on', function ($row) {
                    return date('d-M-Y', strtotime($row->ending_period));
                })
                ->addColumn('status', function ($row) {
                    if($row->ending_period > date('Y-m-d')){
                        $div = '<a href="javascript:;" class="new-campaign-button-active">Active</a>';
                    } else{
                        $div = '<a href="javascript:;" class="new-campaign-button-view">Status Period Ended</a>';
                    }
                    return '<div class="group-buttons categories-progress-view">'.$div.'</div>';
                })
                ->addColumn('action', function ($row) {

                    $btn = '<div class="group-buttons categories-progress-view">
                                <a href="'. route('admin.vote-campaign.view', $row->id) .'" class="new-campaign-button-view">View</a>
                              </div>';

                    return $btn;
                })
                ->rawColumns(['project_name', 'project_type', 'no_of_investor', 'ending_on', 'status', 'action', 'investment_period'])
                ->make(true);
        }
    }

    public function index2(Request $request)
    {
        if ($request->ajax()) {
            $data = VoteCampaigns::selectRaw("vote_campaigns.id,
                vote_campaigns.vote_type as v_type,
                projects.project_name_en,
                vote_campaigns.starting_period,
                vote_campaigns.ending_period,
                vote_campaigns.status,
                count(NULLIF(investor_votes.vote1, '')) as vote1,
                count(NULLIF(investor_votes.vote2, '')) as vote2")
                ->join ('investor_votes', 'investor_votes.vote_campaign_id' , 'vote_campaigns.id')
                ->join('projects', 'vote_campaigns.project_id', '=', 'projects.id')
                ->groupBy("vote_campaigns.id");
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('project_name', function ($row) {
                    return $row->project_name_en;
                })
                ->addColumn('issued_on', function ($row) {
                    return date('d-M-Y', strtotime($row->starting_period));
                })
                ->addColumn('expiry_date', function ($row) {
                    return date('d-M-Y', strtotime($row->ending_period));
                })
                ->addColumn('sell_extend', function ($row) {
                    if ($row->v_type == 'Extend or Sell') {
                        $div = $row->vote2.'/'.$row->vote1;
                    } else {
                        $div = '-';
                    }
                    return $div;
                })
                ->addColumn('agree_disagree', function ($row) {
                    if ($row->v_type == 'Agree or Disagree') {
                        $div = $row->vote1.'/'.$row->vote2;
                    } else {
                        $div = '-';
                    }
                    return $div;
                })
                ->addColumn('accept_reject', function ($row) {
                    if ($row->v_type == 'Accept or Reject') {
                        $div = $row->vote1.'/'.$row->vote2;
                    } else {
                        $div = '-';
                    }
                    return $div;
                })
                ->addColumn('status', function ($row) {
                    $class = $row->status == 1 ? 'new-campaign-button-active' : 'new-campaign-button-view';
                    $content = $row->status == 1 ? 'Active' : 'Deactive';
                    return '<div class="group-buttons categories-progress-view">
                                <a href="javascript:;" class="' . $class . '">' . $content . '</a>
                              </div>';
                })
                ->addColumn('action', function ($row) {
                    $statuschange = $row->status == 1 ? 0 : 1;
                    $class = $row->status == 1 ? 'new-campaign-button-active' : 'new-campaign-button-view';
                    $content = $row->status == 1 ? 'Active' : 'Deactive';
                    $btn = '<div class="group-buttons categories-progress-view">
                                <a href="' . route('admin.vote-campaign.view', $row->id) . '" class="new-campaign-button-view">View</a>
                                <a href="javascript:;" class="' . $class . '" onclick="changeStatus(' . $row->id . ',' . $statuschange . ')">' . $content . '</a>
                              </div>';

                    return $btn;
                })
                ->rawColumns(['project_name', 'project_type', 'no_of_investor', 'ending_on', 'status', 'action', 'investment_period'])
                ->make(true);
        }
    }

    public function addVoteCampaign()
    {
        $campaign_projects = FundingCampaigns::wherestatus(1)->get();
        return view('admin.vote-campaign.addVoteCampaign')->with('campaign_projects', $campaign_projects);
    }

    public function voteCampaignView($id)
    {
        $vote_campaign = VoteCampaigns::findorfail($id);
        return view('admin.vote-campaign.viewVoteCampaign')->with('vote_campaign', $vote_campaign);
    }

    public function viewVoteCampaign($id)
    {
        $vote_campaign = VoteCampaigns::find($id);
        $projects = Project::all()->where('status', 1);
        return view('admin.vote-campaign.viewVoteCampaign')->with('vote_campaign', $vote_campaign)->with('projects', $projects);
    }

    public function changeStatusVoteCampaign(Request $request)
    {
        $campaign = VoteCampaigns::find($request->id);
        $campaign->status = $request->status;
        $campaign->save();
        return response()->json([
            'status' => true,
            'error' => 'Status Change Successfully.'
        ], 200);
    }

    public function postAddVoteCampaign(Request $request)
    {
        $vote_campaign = VoteCampaigns::whereProjectId($request->project_id)->with('project')->first();
        $data = $request->all();
        $validate_data = [
            'project_id' => [
                'required',
                function ($attribute, $value, $fail) use($vote_campaign){
                    if($vote_campaign){
                        if($vote_campaign->ending_period > date('Y-m-d')){
                            return $fail("Vote campaign for this project has already made.");
                        }
                    }
                }
            ],
            'vote_type' => 'required',
            'starting_period' => 'required',
            'ending_period' => [
                'required',
                function ($attribute, $value, $fail) use($data){
                    if($value < $data['starting_period']){
                        return $fail("Ending Period must be greater than starting period");
                    }
                }
            ],
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $vote = new VoteCampaigns();
            $vote->project_id = $request->project_id;
            $vote->vote_type = $request->vote_type;
            $vote->starting_period = date('Y-m-d', strtotime($request->starting_period));
            $vote->ending_period = date('Y-m-d', strtotime($request->ending_period));
            $vote->save();
            $project = Project::select('project_name_en')->whereId($request->project_id)->first();
            $investor_investments = InvestorInvestments::whereProjectId($request->project_id)->get();
            $user_ids = [];
            $notification = [];
            foreach($investor_investments as $investor_investment){
                $user_ids = $investor_investment->user_id;
                $notification[] = [
                    'to' => $user_ids,
                    'subject' => 'Vote Campaign',
                    'purpose' => 'New Vote Campaign',
                    'desc' => 'Admin has created a new vote campaign for "'.$project->project_name_en.'"',
                    'type'=> 'vote_campaign',
                    'project'=> $request->project_id,
                ];
            }
            $this->notification($notification);

            Session::flash('success', "Vote Campaign Added Successfully!");
            return redirect()->route('admin.vote-campaign');
        }
    }
}
