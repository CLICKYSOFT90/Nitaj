<?php

namespace App\Http\Controllers;

use App\Models\InvestorInvestments;
use App\Models\InvestorVotes;
use App\Models\VoteCampaigns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class VoteController extends BaseController
{
    public function voteList(){
        return view('investor.vote.vote');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = InvestorInvestments::select('*')
                ->addSelect('vote_campaigns.id as vc_id', 'vote_campaigns.status as vc_status', 'project_fundings.id as pf_id')
                ->join('projects', 'investor_investments.project_id', '=', 'projects.id')
                ->join('vote_campaigns', 'investor_investments.project_id', '=', 'vote_campaigns.project_id')
                ->leftJoin('project_fundings', 'project_fundings.project_id', '=', 'projects.id')
                ->where('investor_investments.user_id', auth()->user()->id)
                ->where('vote_campaigns.status', 1)
                ->where('vote_campaigns.ending_period','>', date('Y-m-d'));
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('project_name', function ($row) {
                    return App::getLocale() == 'en' ? $row->project_name_en : $row->project_name_ar;
                })
                ->addColumn('asset_type', function ($row) {
                    return App::getLocale() == 'en' ? $row->asset_type_en : $row->asset_type_ar;
                })
                ->addColumn('amount_funded', function ($row) {
                    return '';
                })
                ->addColumn('equity_share', function ($row) {
                    return '';
                })
                ->addColumn('project_type', function ($row) {
                    return App::getLocale() == 'en' ? $row->project_type_en : $row->project_type_ar;
                })
                ->addColumn('status', function ($row) {
                    return $row->vc_status;
                })
                ->addColumn('action', function ($row) {

                    $btn = '<div class="group-buttons categories-progress-view">
                                <a href="'.route('investor.vote.view', $row->vc_id).'" class="buy-view-btn">'.__('vote.Vote').'</a>
                              </div>';

                    return $btn;
                })
                ->rawColumns(['project_name','asset_type','amount_funded','equity_share','status','action','project_type'])
                ->make(true);
        }
    }

    public function index2(Request $request)
    {
        if ($request->ajax()) {
            $data = InvestorVotes::select('*')
                ->addSelect('vote_campaigns.status as vc_status')
                ->join('vote_campaigns', 'vote_campaigns.id', '=', 'investor_votes.vote_campaign_id')
                ->join('projects', 'vote_campaigns.project_id', '=', 'projects.id')
                ->where('investor_votes.user_id',auth()->user()->id)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('project_name', function ($row) {
                    return $row->project_name_en;
                })
                ->addColumn('asset_type', function ($row) {
                    return $row->asset_type_en;
                })
                ->addColumn('amount_funded', function ($row) {
                    return '';
                })
                ->addColumn('equity_share', function ($row) {
                    return '';
                })
                ->addColumn('project_type', function ($row) {
                    return $row->project_type_en;
                })
                ->addColumn('status', function ($row) {
                    return $row->vc_status;
                })
                ->addColumn('action', function ($row) {
                    $vote = !empty($row->vote1) ? $row->vote1 : $row->vote2;
                    $btn = '<div class="group-buttons categories-progress-view v-now">
                                <a href="javascript:;" class="buy-view-btn">'.$vote.'</a>
                              </div>';

                    return $btn;
                })
                ->rawColumns(['project_name','asset_type','amount_funded','equity_share','status','action','project_type'])
                ->make(true);
        }
    }

    public function getVoteCampaign($vote_campaign_id){
        $vote_campaign = VoteCampaigns::whereid($vote_campaign_id)
            ->with('project')
            ->first();
        if($vote_campaign){
            return view('investor.vote.viewVote')->with('vote_campaign', $vote_campaign);
        } else{
            Session::flash('alert', "Not Found");
            return redirect()->back();
        }
    }

    public function castInvestorVote(Request $request){
        $validate_data = [
            'vote_type' => 'required',
            'chk-box' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $voted = InvestorVotes::whereuser_id($request->user_id)->wherevote_campaign_id($request->vote_campaign_id)->first();
            if($voted){
                return response()->json([
                    'status' => false,
                    'error' => 'You already casted the vote.'
                ], 200);
            } else {
                $votes = new InvestorVotes();
                $votes->user_id = $request->user_id;
                $votes->vote_campaign_id = $request->vote_campaign_id;
                if($request->vote_cat == 'extend_or_sell'){
                    $votes->vote1 = $request->vote_type == 'Extend' ? 'Extend' : '';
                    $votes->vote2 = $request->vote_type == 'Sell' ? 'Sell' : '';
                }
                if($request->vote_cat == 'agree_or_disagree'){
                    $votes->vote1 = $request->vote_type == 'Agree' ? 'Agree' : '';
                    $votes->vote2 = $request->vote_type == 'Disagree' ? 'Disagree' : '';
                }
                if($request->vote_cat == 'accept_or_reject'){
                    $votes->vote1 = $request->vote_type == 'Accept' ? 'Accept' : '';
                    $votes->vote2 = $request->vote_type == 'Reject' ? 'Reject' : '';
                }
                $votes->save();
                $vote_campaign = VoteCampaigns::findorfail($request->vote_campaign_id);
                $activity = [
                    'user_id' => $request->user_id,
                    'title' => 'Vote Campaign',
                    'project_id' => $vote_campaign->project_id,
                    'vote_campaign_id' => $request->vote_campaign_id,
                    'type' => 'vote_campaign'
                ];
                recentActivity($activity);
                return response()->json([
                    'status' => true,
                    'error' => 'Vote Cast Successfully!'
                ], 200);
            }
        }
    }
}
