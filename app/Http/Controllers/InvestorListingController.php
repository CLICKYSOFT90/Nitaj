<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\VoteCampaigns;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class InvestorListingController extends Controller
{
    public function investorsList()
    {
        return view('admin.investor-listing.investors');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*')->whereis_admin(0)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->fname.' '.$row->lname;
                })
                ->addColumn('user_type', function ($row) {
//                    $role_array = json_encode($row->getRoleNames());
//                    $decode_array =  json_decode($role_array);
//                    return $decode_array[0] == 'real_estate' ? 'Invest in real estate' : 'Raise funds';
//                    return str_replace('_',' ', $decode_array);
                    return $row->type == 1 ? 'Professional Investor' : 'Regular Investor';
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at));
                })
                ->addColumn('national_id', function ($row) {
                    return !empty($row->nationalIdVeriification[0]) ? $row->nationalIdVeriification[0]->national_id : '';
                })
                ->addColumn('status', function ($row) {
                    $class = $row->status == 1 ? 'new-campaign-button-active' : 'new-campaign-button-view';
                    $status = $row->status == 1 ? 'Active' : 'Deactive';
                    $statuschange = $row->status == 1 ? 0 : 1;
                    $div = '<div class="group-buttons categories-progress-view text-left">
                                <a href="'.route('admin.investor.view', $row->id).'" class="new-campaign-button-view">View</a>
                                <a href="javascript:;" onclick="changeStatus('.$row->id.','.$statuschange.')" class="'.$class.'">'.$status.'</a>
                                <a href="javascript:;" class="new-campaign-button-view"  onclick="delete_investor('.$row->id.')">Delete</a>
                            </div>';
                    return $div;
                })
                ->rawColumns(['id','name', 'user_type', 'created_at', 'national_id', 'status'])
                ->make(true);
        }
    }

    public function voteCampaignListing(Request $request)
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
//                ->where('investor_votes.user_id',)
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
                        $div = $row->vote1.'/'.$row->vote2;
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

    public function viewInvestors($user_id)
    {
        $user = User::whereId($user_id)->with('usersInvestments')->first();
        if($user) {
            $role_array = json_encode($user->getRoleNames());
            $decode_array = json_decode($role_array);
            $role = str_replace('_', ' ', $decode_array);
            return view('admin.investor-listing.viewInvestor')->with('user', $user)->with('role', $role);
        } else{
            Session::flash('alert', "No User Found");
            return redirect()->back();
        }
    }

    public function changeInvestorStatus(Request $request)
    {
        $project = User::find($request->investor_id);
        $project->status = $request->status;
        $project->save();
        return response()->json([
            'status' => true,
            'error' => "Investor Status Updated!",
        ], 200);
    }

    public function deleteInvestor(Request $request)
    {
        $user = User::findorfail($request->investor_id)->delete();
        if($user){
            return response()->json([
                'status' => true,
                'error' => "Investor Deleted Successfully",
            ], 200);
        } else{
            return response()->json([
                'status' => true,
                'error' => "Oops! Something went wrong.",
            ], 200);
        }
    }
}
