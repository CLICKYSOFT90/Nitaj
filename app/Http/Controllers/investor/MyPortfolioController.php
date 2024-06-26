<?php

namespace App\Http\Controllers\investor;

use App\Http\Controllers\BaseController;
use App\Models\InvestorInvestments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Facades\DataTables;

class MyPortfolioController extends BaseController
{
    public function myPortfolio(){
        return view('investor.my-portfolio.my-portfolio');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = InvestorInvestments::select('*')
                ->whereuser_id(auth()->user()->id)
                ->get();
//            dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('project_name', function ($row) {
                    return App::getLocale() == 'en' ? $row->projects->project_name_en : $row->projects->project_name_ar;
                })
                ->addColumn('project_type', function ($row) {
                    return App::getLocale() == 'en' ? $row->projects->project_type_en : $row->projects->project_type_ar;
                })
                ->addColumn('project_market_value', function ($row) {
                    return number_format($row->projects->projectFunding->funding_required);
                })
                ->addColumn('equity_share', function ($row) {
                    return $row->no_of_shares - $row->sold_shares;
                })
                ->addColumn('portfolio', function ($row) {
                    $project_funding = $row->projects->projectFunding->funding_required;
                    $price_per_share = $row->projects->projectFunding->price_per_share;
                    $total_shares = $row->no_of_shares - $row->sold_shares;
                    $amount_invested = $total_shares * $price_per_share;
                    $portfolio_percentage = ($amount_invested/$project_funding) * 100;
//                    $user_wallet = getUserWallet(auth()->user()->id);
//                    $total_amount = $row->amount_invested + $user_wallet;
//                    $abc = $total_amount - $user_wallet;
//                    $abc = ($abc / $total_amount) * 100;
//                    dd($user_wallet, $total_amount, $abc);
                    return number_format($portfolio_percentage, 2).' %';
                })
                ->addColumn('position_total', function ($row) {
                    $price_per_share = $row->projects->projectFunding->price_per_share;
                    $total_shares = $row->no_of_shares - $row->sold_shares;
                    $amount_invested = $total_shares * $price_per_share;
                    return number_format($amount_invested);
//                    return $row->no_of_shares * $row->amount_invested;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="group-buttons">
                                <a href="'.route('investor.projects.detail', $row->project_id).'" class="buy-view-btn">View</a>
                            </div>';
                })
                ->rawColumns(['project_name','project_type','project_market_value', 'equity_share', 'portfolio', 'position_total','action'])
                ->make(true);
        }
    }

}
