<?php

use App\Models\InvestorInvestments;
use App\Models\ProjectFundings;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

function checkRemainingFunding($project_id)
{
//    $project = \App\Models\Project::find($project_id);
//    $shares_amount = \App\Models\InvestorInvestments::whereproject_id($project_id)->whereStatus(1)->whereAdminApproved(1)->sum('amount_invested');
//    $remaining_required = $project->projectFunding->funding_required - $shares_amount;
//    $remaining_amount = $remaining_required / $project->projectFunding->funding_required;
//    $percent = $remaining_amount * 100;
//    return round(100 - $percent, 1);
    $project = \App\Models\Project::find($project_id);
    $shares_amount = \App\Models\InvestorInvestments::select('*')
        ->addSelect(DB::raw("sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares, project_fundings.price_per_share * sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_amount"))
        ->join('project_fundings', 'investor_investments.project_id', '=', 'project_fundings.project_id')
        ->groupby('investor_investments.project_id')
        ->where('investor_investments.project_id', $project_id)
        ->first();
    $shares_total = isset($shares_amount) ? $shares_amount->total_amount : 0;
    $remaining_required = $shares_total / $project->projectFunding->funding_required;
    $percent = $remaining_required * 100;
    return round($percent, 2);

}

function getUserWallet($user_id)
{
    $user_wallet = \App\Models\UserWallets::whereuser_id($user_id)->first();
    return number_format($user_wallet->amount - $user_wallet->deducted_amount + $user_wallet->added_amount);
}

function convertCommaToInteger($value)
{
    return str_replace(',', '', $value);
}

function number_format_short($n)
{
    if ($n > 0 && $n < 1000) {
        // 1 - 999
        $n_format = floor($n);
        $suffix = '';
    } else if ($n >= 1000 && $n < 1000000) {
        // 1k-999k
        $n_format = floor($n / 1000);
        $suffix = 'K';
    } else if ($n >= 1000000 && $n < 1000000000) {
        // 1m-999m
        $n_format = floor($n / 1000000);
        $suffix = 'M';
    } else if ($n >= 1000000000 && $n < 1000000000000) {
        // 1b-999b
        $n_format = floor($n / 1000000000);
        $suffix = 'B';
    } else if ($n >= 1000000000000) {
        // 1t+
        $n_format = floor($n / 1000000000000);
        $suffix = 'T';
    } else {
        $n_format = 0;
        $suffix = '';
    }

    return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
}

function getUserInvestments($user_id)
{
    $total_amount = 0;
    $invested = \App\Models\InvestorInvestments::select('*')
        ->addSelect(DB::raw("sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares, project_fundings.price_per_share * sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_amount"))
        ->join('project_fundings', 'investor_investments.project_id', '=', 'project_fundings.project_id')
        ->groupby('investor_investments.project_id')
        ->whereUserId($user_id)->get();
    foreach ($invested as $investments) {
//        $price_per_share = $investments->amount_invested / $investments->no_of_shares;
//        $total_shares_after_sale = $investments->no_of_shares - $investments->sold_shares;
//        $total_amount += $price_per_share * $total_shares_after_sale;
        $total_amount += $investments->total_amount;
    }
    return $total_amount;
}

function totalDividends($user_id)
{
    $dividends = \App\Models\WalletLogs::whereUserId($user_id)->sum('dividends');
    $interest_recieved = \App\Models\WalletLogs::whereUserId($user_id)->sum('interest_recieved');
    return $dividends + $interest_recieved;
}

function totalUnrealizedReturns($user_id)
{
    $unrealized = \App\Models\WalletLogs::whereUserId($user_id)->sum('unrealized');
    $interest_tobe_recieved = \App\Models\WalletLogs::whereUserId($user_id)->sum('interest_tobe_recieved');
    return $unrealized + $interest_tobe_recieved;
}

function totalRealizedReturns($user_id)
{
    $realized = \App\Models\WalletLogs::whereUserId($user_id)->sum('realized');
    $interest_recieved = \App\Models\WalletLogs::whereUserId($user_id)->sum('interest_recieved');
    return $realized + $interest_recieved;
}

function totalNoOfInvestments($user_id)
{
    $total_investiments = \App\Models\InvestorInvestments::whereUserId($user_id)->count();
    return $total_investiments;
}

function totalProfit($user_id)
{
    $total_investiments = \App\Models\WalletLogs::whereUserId($user_id)->sum('sale_profit');
    return $total_investiments;
}

function totalDeposits($user_id)
{
    $amount = 0;
    $deposits = \App\Models\WalletLogs::where(['user_id' => $user_id, 'type' => 'deposit'])->get();
    foreach ($deposits as $deposit) {
        $amount += $deposit->amount;
    }
    return $amount;
}

function annualizedROI($user_id)
{
    $investor_investments = InvestorInvestments::selectRaw(
        '*,
            sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares,
            sum(investor_investments.no_of_shares - investor_investments.sold_shares) * project_fundings.price_per_share as total_amount,
            investor_investments.created_at as investment_date,
            reports.created_at as report_created_at
        ')
        ->join('projects', 'projects.id', '=', 'investor_investments.project_id')
        ->join('project_fundings', 'project_fundings.project_id', '=', 'investor_investments.project_id')
        ->join('reports', 'reports.project_id', '=', 'investor_investments.project_id')
//        ->join('reports', function ($query) {
//            $query->on('reports.project_id', '=', 'investor_investments.project_id')
//                ->orderby('reports.created_at', 'DESC');
//        })
        ->has('userWalletLogs')
        ->with('userWalletLogs')
        ->where(['investor_investments.user_id' => $user_id])
        ->having('total_shares', '>', 0)
        ->orderby('reports.created_at', 'desc')
        ->groupBy('investor_investments.project_id')
        ->get();
    $user_investments = getUserInvestments($user_id);
    if (count($investor_investments) > 0) {
        foreach ($investor_investments as $key => $investor_investment) {
            //Calculating holding period
            if ($investor_investment->structure == 'Equity' && $investor_investment->is_sold == 1) {
                $date1 = new DateTime($investor_investment->investment_date);
                $date2 = new DateTime($investor_investment->sold_at);
                $interval = $date2->diff($date1);
                $months = ($interval->y * 12) + $interval->m;
                $months += number_format($interval->d / 30, 1);
                $annual_roi[] = round((((
                                    $investor_investment->userWalletLogs[0]->realized +
                                    $investor_investment->userWalletLogs[0]->unrealized +
                                    $investor_investment->userWalletLogs[0]->interest_tobe_recieved +
                                    $investor_investment->userWalletLogs[0]->interest_recieved) / $investor_investment->total_amount) / $months * 12) * 100) / 100 * $investor_investment->total_amount;


            }
            if ($investor_investment->structure == 'Equity' && $investor_investment->is_sold == 0) {
                $date1 = new DateTime($investor_investment->investment_date);
                $date2 = new DateTime($investor_investment->report_created_at);
                $interval = $date2->diff($date1);
                $months = ($interval->y * 12) + $interval->m;
                $months += number_format($interval->d / 30, 1);
//                dd($investor_investment->investment_date, $investor_investment->report_created_at, $months);

                $annual_roi[] = round((((
                                    $investor_investment->userWalletLogs[0]->realized +
                                    $investor_investment->userWalletLogs[0]->unrealized +
                                    $investor_investment->userWalletLogs[0]->interest_tobe_recieved +
                                    $investor_investment->userWalletLogs[0]->interest_recieved) / $investor_investment->total_amount) / $months * 12) * 100) / 100 * $investor_investment->total_amount;
            }
            if ($investor_investment->structure == 'Debt' && $investor_investment->is_sold == 1) {

                $date1 = new DateTime($investor_investment->investment_date);
                $date2 = new DateTime($investor_investment->sold_at);
                $interval = $date2->diff($date1);
                $months = ($interval->y * 12) + $interval->m;
                $months += number_format($interval->d / 30, 1);

                $annual_roi[] = round((((
                                    $investor_investment->userWalletLogs[0]->realized +
                                    $investor_investment->userWalletLogs[0]->unrealized +
                                    $investor_investment->userWalletLogs[0]->interest_tobe_recieved +
                                    $investor_investment->userWalletLogs[0]->interest_recieved) / $investor_investment->total_amount) / $months * 12) * 100) / 100 * $investor_investment->total_amount;
            }
            if ($investor_investment->structure == 'Debt' && $investor_investment->is_sold == 0) {

                $date1 = new DateTime($investor_investment->investment_date);
                $date2 = new DateTime($investor_investment->report_created_at);
                $interval = $date2->diff($date1);
                $months = ($interval->y * 12) + $interval->m;
                $months += number_format($interval->d / 30, 1);

                $annual_roi[] = round((((
                                    $investor_investment->userWalletLogs[0]->realized +
                                    $investor_investment->userWalletLogs[0]->unrealized +
                                    $investor_investment->userWalletLogs[0]->interest_tobe_recieved +
                                    $investor_investment->userWalletLogs[0]->interest_recieved) / $investor_investment->total_amount) / $months * 12) * 100) / 100 * $investor_investment->total_amount;
            }
        }
        $sum = array_sum($annual_roi);
        $annualaized_roi = round(($sum / $user_investments) * 100, 2);
        return $annualaized_roi . '%';
    } else {
        return 0;
    }
}

function getUserInvestmentsByProject($user_id, $project_id)
{
    $total_amount = 0;
    $invested = \App\Models\InvestorInvestments::whereUserId($user_id)->whereProjectId($project_id)->get();
    $price = \App\Models\ProjectFundings::whereProject_id($project_id)->pluck('price_per_share')->first();
    foreach ($invested as $investments) {
//        $price_per_share = $investments->amount_invested / $investments->no_of_shares;
        $price_per_share = $price;
        $total_shares_after_sale = $investments->no_of_shares - $investments->sold_shares;
        $total_amount += $price_per_share * $total_shares_after_sale;
    }
    return $total_amount;
}

function getUserProjectShares($user_id, $project_id)
{
    $total_shares_after_sale = 0;
    $invested = \App\Models\InvestorInvestments::whereUserId($user_id)->whereProjectId($project_id)->get();
    $project = \App\Models\Project::findorfail($project_id);
    foreach ($invested as $investments) {
//        $price_per_share = $investments->amount_invested / $investments->no_of_shares;
        $price_per_share = $project->projectFunding->price_per_share;
        $total_shares_after_sale = $investments->no_of_shares - $investments->sold_shares;
    }
    return ($total_shares_after_sale / $project->projectFunding->no_of_shares) * 100;
}

function getUserEquityWallet($user_id)
{
    $remaining_share_price = 0;
    $investements = \App\Models\InvestorInvestments::whereUserId($user_id)->get();
    foreach ($investements as $total_equity) {
        $price_per_share = $total_equity->amount_invested / $total_equity->no_of_shares;
        $remaining_shares = $total_equity->no_of_shares - $total_equity->sold_shares;
        $remaining_share_price += $remaining_shares * $price_per_share;
    }
    return $remaining_share_price;
}

function getUserDebitWallet($user_id)
{
    $remaining_share_price = 0;
    $investements = \App\Models\InvestorInvestments::whereUserId($user_id)->get();
    foreach ($investements as $total_equity) {
        $price_per_share = $total_equity->amount_invested / $total_equity->no_of_shares;
        $remaining_share_price += $total_equity->sold_shares * $price_per_share;
    }
    return $remaining_share_price;
}

function getUserTransactions($user_id)
{
    $transaction = \App\Models\WithdrawRequests::whereUserId($user_id)->whereStatus(1)->whereConfirm(1)->count();
    return $transaction;
}

function getProjectDetails($project_id)
{
    $project = \App\Models\Project::findorfail($project_id);
    return $project;
}

function getUser($user_id)
{
    $user = \App\Models\User::findorfail($user_id);
    return $user;
}


function recentActivity(array $data)
{
    $activity = new \App\Models\RecentActivities();
    $activity->user_id = $data['user_id'];
    $activity->title = $data['title'];
    $activity->project_id = $data['project_id'];
    $activity->type = $data['type'];
    $activity->save();
}

function getUserRegistrationSteps($user_id)
{
    $steps = \App\Models\RegistrationStep::whereUserId($user_id)->get();
    return $steps;
}

function getProjectFunds($project_id)
{
    $amount = 0;
    $investments = InvestorInvestments::where('project_id', $project_id)->whereRaw('no_of_shares - sold_shares > 0')->get();
    foreach ($investments as $investment) {
        $price_per_share = $investment->amount_invested / $investment->no_of_shares;
        $remaining_shares = $investment->no_of_shares - $investment->sold_shares;
        $amount += $remaining_shares * $price_per_share;
    }
    return $amount;
}

function getProjectTotalInvestments($project_id)
{
    $amount = InvestorInvestments::select('*')
        ->addSelect(DB::raw("investor_investments.no_of_shares - investor_investments.sold_shares as total_shares, project_fundings.price_per_share * sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_amount"))
        ->join('project_fundings', 'investor_investments.project_id', '=', 'project_fundings.project_id')
        ->where('investor_investments.project_id', $project_id)
        ->first();
    return number_format($amount->total_amount) . ' SAR';
}

