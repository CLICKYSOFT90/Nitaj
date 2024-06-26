<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseController;
use App\Models\Biddings;
use App\Models\Settings;
use App\Models\ShareForSales;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShareListController extends BaseController
{
    public function sharesList(){
        return view('admin.share-list.share-list');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ShareForSales::select('*')->orderBy('created_at', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user_id', function ($row) {
                    return $row->user_id;
                })
                ->addColumn('project_name', function ($row) {
                    return $row->project->project_name_en;
                })
                ->addColumn('no_of_share', function ($row) {
                    return $row->no_of_shares - $row->sold_shares;
                })
                ->addColumn('price_per_share', function ($row) {
                    return $row->amount / $row->no_of_shares;
                })
                ->addColumn('bids', function ($row) {
                    return $row->bidding->count();
                })
                ->rawColumns(['user_id', 'project_name', 'no_of_share', 'price_per_share', 'bids'])
                ->make(true);
        }
    }

    public function bidOffers(Request $request)
    {
        if ($request->ajax()) {
            $data = ShareForSales::select('*')->orderBy('created_at', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user_id', function ($row) {
                    return $row->user_id;
                })
                ->addColumn('project_name', function ($row) {
                    return $row->project->project_name_en;
                })
                ->addColumn('no_of_share', function ($row) {
                    return $row->no_of_shares - $row->sold_shares;
                })
                ->addColumn('price_per_share', function ($row) {
                    return $row->amount / $row->no_of_shares;
                })
                ->addColumn('shareholder_id', function ($row) {
                    return $row->user_id;
                })
                ->addColumn('total_amount', function ($row) {
                    return $row->amount.' SAR';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="group-buttons">
                                <a href="javascript:;" class="buy-accept-btn" onclick="biddingList('.$row->id.')">View Bids</a>
                            </div>';
                })
                ->rawColumns(['user_id', 'project_name', 'no_of_share', 'price_per_share', 'shareholder_id', 'date_of_bid', 'total_amount', 'status', 'action'])
                ->make(true);
        }
    }
    public function bidOffersListing(Request $request, $bid_id)
    {
        if ($request->ajax()) {
            $data = Biddings::select('*')
                ->whereshare_for_sales_id($bid_id)
                ->orderBy('created_at', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('bidder_id', function ($row) {
                    return $row->bidder_user_id;
                })
                ->addColumn('no_of_share', function ($row) {
                    return $row->no_of_shares;
                })
                ->addColumn('price_per_share', function ($row) {
                    return $row->amount / $row->no_of_shares;
                })
                ->addColumn('amount', function ($row) {
                    return $row->amount;
                })
                ->addColumn('total', function ($row) {
                    $settings = Settings::first();
                    $vat = $settings->vat / 100 * $row->amount;
                    $fee = $settings->fee / 100 * $row->amount;
                    $nitaj_fee = $settings->nitaj_exit_fee  / 100 * $row->amount;
                    return $row->amount + $vat + $fee + $nitaj_fee;
                })
                ->addColumn('date_of_bid', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->addColumn('Status', function ($row) {
                    if($row->status == 1){
                        $div = '<a href="javascript:;" class="buy-accept-btn">Accepted</a>';
                    } else if($row->status == 0){
                        $div = '<a href="javascript:;" class="buy-rejected-btn">Rejected</a>';
                    } else{
                        $div = '<a href="javascript:;" class="buy-pending-btn">Pending</a>';
                    }
                    return '<div class="group-buttons">
                                '.$div.'
                            </div>';
                })
                ->rawColumns(['bidder_id', 'no_of_share', 'price_per_share', 'amount', 'date_of_bid', 'Status'])
                ->make(true);
        }
    }
}
