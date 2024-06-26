<?php

namespace App\Http\Controllers;

use App\Models\InvestorInvestments;
use App\Models\InvestorReportProgressSummarys;
use App\Models\RecentActivities;
use App\Models\WalletLogs;
use App\Models\WithdrawRequests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestorController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $filter = null)
    {
        $month_tenure = $filter ?? 6;

        //Withdrawls
        $withdrawals = WithdrawRequests::selectRaw('DATE_FORMAT(created_at,"%m") as date , count(created_at) as total')
            ->whereBetween('created_at', [Carbon::now()->subMonth($month_tenure - 1), Carbon::now()])
            ->groupBy("date")
            ->whereUserId(auth()->user()->id)
//            ->latest()
            ->orderBy('created_at', 'ASC')
            ->get();

        $months = [];
        for ($i = 0; $i < $month_tenure; $i++) {
            $months[] = Carbon::now()->subMonth($i)->format('m');
            $month_format[] = Carbon::now()->subMonth($i)->format('M');
        }
        $month_format = '"' . implode('","', $month_format) . '"';

        foreach ($months as $month) {
            $rec = $withdrawals->where('date', $month)->first();
            if ($rec)
                $withdrawl_total[] = $rec['total'];
            else
                $withdrawl_total[] = 0;
        }
        $withdrawl_total = implode(',', $withdrawl_total);

        //Calculating Dividends
        $dividends = WalletLogs::selectRaw('DATE_FORMAT(created_at,"%m") as date , sum(amount) as total')
            ->whereBetween('created_at', [Carbon::now()->subMonth($month_tenure - 1), Carbon::now()])
            ->groupBy("date")
            ->whereUserId(auth()->user()->id)
            ->latest()
            ->get();
        foreach ($months as $month) {
            $rec = $dividends->where('date', $month)->first();
            if ($rec)
                $dividends_total[] = $rec['total'];
            else
                $dividends_total[] = 0;
        }
        $dividends_total = implode(',', $dividends_total);

        //Account Valuation = Wallet Balance + worth of total shares of unsold projects
        $acc_valuation = InvestorInvestments::selectRaw('
                investor_investments.user_id as user_id,
                projects.id as project_id,
                DATE_FORMAT(investor_investments.created_at,"%m") as date,
                sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares,
                sum(investor_investments.no_of_shares - investor_investments.sold_shares) * project_fundings.price_per_share as total
            ')
            ->join('project_fundings', 'project_fundings.project_id', '=', 'investor_investments.project_id')
            ->join('projects', 'projects.id', '=', 'investor_investments.project_id')
            ->whereBetween('investor_investments.created_at', [Carbon::now()->subMonth($month_tenure - 1), Carbon::now()])
            ->groupBy("investor_investments.project_id")
            ->groupBy("date")
            ->whereUserId(auth()->user()->id)
            ->whereIsSold(0)
            ->orderBy('investor_investments.created_at', 'DESC')
            ->get();

        foreach ($months as $key => $month) {
            $rec = $acc_valuation->where('date', $month)->sum('total');
            if ($rec)
                $acc_valuation_total[] = $rec;
            else
                $acc_valuation_total[] = 0;
        }
        $acc_valuation_total = implode(',', $acc_valuation_total);

        //Recent Activity
        $activities = RecentActivities::whereUserId(auth()->user()->id)->with('project')->latest()->take(3)->get();

        //Capital Allocation
        $capital_allocation = InvestorInvestments::select('*')
            ->selectRaw('(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares, project_fundings.price_per_share * sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_amount')
            ->leftjoin('projects', 'investor_investments.project_id', '=', 'projects.id')
            ->leftjoin('project_fundings', 'investor_investments.project_id', '=', 'project_fundings.project_id')
            ->where(['user_id' => auth()->user()->id])
            ->having('total_shares', '>', 0)
            ->groupby('projects.asset_type_en')
            ->pluck('total_amount', 'asset_type_en')
            ->toArray();
        $labels = [];
        $values = [];
        foreach ($capital_allocation as $key => $capital) {
            $labels[] = $key;
            $values[] = $capital;
        }
        $labels = implode(",", $labels);
        $values = implode(",", $values);

        return view('investor.dashboard')
            ->with('activities', $activities)
            ->with('labels', $labels)
            ->with('values', $values)
            ->with('capital_allocation', $capital_allocation)
            ->with('month_format', $month_format)
            ->with('withdrawl_total', $withdrawl_total)
            ->with('dividends_total', $dividends_total)
            ->with('acc_valuation_total', $acc_valuation_total);
    }

    public function portfolio()
    {
        return view('investor.portfolio');
    }
}
