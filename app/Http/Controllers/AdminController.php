<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InvestorInvestments;
use App\Models\Project;
use App\Models\RecentActivities;
use App\Models\User;
use App\Models\WithdrawRequests;
use Carbon\Carbon;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Str;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function adminHome()
    {
        $data['investors'] = User::all()->where('is_admin', 0)->count();
        $data['total_investments'] = InvestorInvestments::select('*')
            ->addSelect(DB::raw("investor_investments.no_of_shares - investor_investments.sold_shares as total_shares, project_fundings.price_per_share * sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_amount"))
            ->join('project_fundings', 'investor_investments.project_id', '=', 'project_fundings.project_id')
            ->get();
        //Recent Activity
        $data['activities'] = RecentActivities::whereUserId(auth()->user()->id)->with('project')->latest()->take(3)->get();

        //Withdrawl Requests
        $withdrawals = WithdrawRequests::selectRaw('DATE_FORMAT(created_at,"%y-%m-%d") as date , count(created_at) as total')
            ->whereMonth('created_at', Carbon::now()->month)
            ->groupBy("date")
            ->orderBy('created_at')
            ->get();
        $now = Carbon::now();
        $passed = Carbon::now()->firstOfMonth();
        $dates = [];
        for ($i = 0; $i <= $now->diffInDays($passed); $i++) {
            $dates[] = Carbon::now()->firstOfMonth()->addDay($i)->format('y-m-d');
            $date_format[] = Carbon::now()->firstOfMonth()->addDay($i)->format('d-M');
        }
        foreach ($dates as $date){
            $rec = $withdrawals->where('date', $date)->first();
            if ($rec)
                $graph_total[] = $rec['total'];
            else
                $graph_total[] = 0;
        }
        $graph_total = implode(",",$graph_total);
        $date_format = '"'.implode('","',$date_format).'"';
        //Count Of Total No of investors
        $no_of_investors = User::select('*')
            ->selectRaw('DATE_FORMAT(created_at,"%y-%m-%d") as date , count(created_at) as total')
                    ->whereMonth('created_at', Carbon::now()->month)
                    ->groupBy("date")
                    ->orderBy('created_at')
                    ->get();
        foreach ($dates as $date){
            $rec = $no_of_investors->where('date', $date)->first();
            if ($rec)
                $investor_total[] = $rec['total'];
            else
                $investor_total[] = 0;
        }
        $investor_total = implode(",",$investor_total);

        //Amount Raised
        $amount_raised = InvestorInvestments::select('*')
            ->selectRaw('DATE_FORMAT(investor_investments.created_at,"%y-%m-%d") as date, investor_investments.no_of_shares - investor_investments.sold_shares as total_shares, project_fundings.price_per_share * sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total')
            ->join('project_fundings', 'investor_investments.project_id', '=', 'project_fundings.project_id')
            ->whereMonth('investor_investments.created_at', Carbon::now()->month)
            ->groupBy("date")
            ->orderBy('investor_investments.created_at')
            ->get();
        foreach ($dates as $date){
            $rec = $amount_raised->where('date', $date)->first();
            if ($rec)
                $amount_total[] = $rec['total'];
            else
                $amount_total[] = 0;
        }
        $amount_total = implode(",",$amount_total);

        //No Of Projects Created
        $no_of_projects = Project::select('*')
            ->selectRaw('DATE_FORMAT(created_at,"%y-%m-%d") as date , count(created_at) as total')
            ->whereMonth('created_at', Carbon::now()->month)
            ->groupBy("date")
            ->orderBy('created_at')
            ->get();
        foreach ($dates as $date){
            $rec = $no_of_projects->where('date', $date)->first();
            if ($rec)
                $project_total[] = $rec['total'];
            else
                $project_total[] = 0;
        }
        $project_total = implode(",",$project_total);

        return view('admin.adminHome')->with([
            'data' => $data,
            'date_format' => $date_format,
            'graph_total' => $graph_total,
            'investor_total' => $investor_total,
            'amount_total' => $amount_total,
            'project_total' => $project_total,
        ]);
    }


}
