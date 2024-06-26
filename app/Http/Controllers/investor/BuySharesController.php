<?php

namespace App\Http\Controllers\investor;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Biddings;
use App\Models\InvestorInvestments;
use App\Models\Settings;
use App\Models\ShareForSales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BuySharesController extends BaseController
{
    public function getBuyShares(){
        return view('investor.share-for-sale.buy-share');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ShareForSales::select('*')
                ->addSelect('share_for_sales.id as sfs_id')
                ->join('projects', 'share_for_sales.project_id', '=', 'projects.id')
                ->where('share_for_sales.status',0)
                ->orderBy('share_for_sales.created_at', 'DESC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('project_name', function ($row) {
                    return App::getLocale() == 'en' ? $row->project_name_en : $row->project_name_ar;
                })
                ->addColumn('no_of_share', function ($row) {
                    return $row->no_of_shares;
                })
                ->addColumn('price_per_share', function ($row) {
                    return $row->amount/$row->no_of_shares;
                })
                ->addColumn('total_amount', function ($row) {
                    $settings = Settings::first();
                    $vat = $settings->vat / 100 * $row->amount;
                     $fee = $settings->fee / 100 * $row->amount;
                     $nitaj_fee = $settings->nitaj_exit_fee  / 100 * $row->amount;
                     return $row->amount + $vat + $fee + $nitaj_fee;
                })
                ->addColumn('bids', function ($row) {
                    return '<div class="group-buttons">
                                <a href="'.route('investor.buy.shares.details', $row->sfs_id).'" class="buy-view-btn">'.__('shares.View').'</a>
                            </div>';
                })
                ->rawColumns(['project_name','no_of_share','price_per_share','bids'])
                ->make(true);
        }
    }

    public function bidList(Request $request)
    {
        if ($request->ajax()) {
            $bid_list = Biddings::select('*')
                ->addSelect('biddings.status as b_status')
                ->join('projects', 'biddings.project_id', '=', 'projects.id')
                ->where('biddings.bidder_user_id',auth()->user()->id)
                ->orderBy('biddings.created_at', 'DESC')
                ->get();
            return Datatables::of($bid_list)
                ->addIndexColumn()
                ->addColumn('project_name', function ($row) {
                    return App::getLocale() == 'en' ? $row->project_name_en : $row->project_name_ar;
                })
                ->addColumn('no_of_share', function ($row) {
                    return $row->no_of_shares;
                })
                ->addColumn('price_per_share', function ($row) {
                    return $row->amount / $row->no_of_shares;
                })
                ->addColumn('total_amount', function ($row) {
                    $settings = Settings::first();
                    $vat = $settings->vat / 100 * $row->amount;
                    $fee = $settings->fee / 100 * $row->amount;
                    $nitaj_fee = $settings->nitaj_exit_fee  / 100 * $row->amount;
                    return $row->amount + $vat + $fee + $nitaj_fee;
                })
                ->addColumn('status', function ($row) {
                    if($row->b_status == 2){
                        $div = '<a href="javascript:;" class="buy-pending-btn">'. __('shares.Pending').'</a>';
                    } else if($row->b_status == 1){
                        $div = '<a href="javascript:;" class="buy-accept-btn">'. __('shares.Accepted').'</a>';
                    } else{
                        $div = '<a href="javascript:;" class="buy-rejected-btn">'. __('shares.Rejected').'</a>';
                    }
                    return '<div class="group-buttons">
                            '.$div.'
                            </div>';
                })
                ->rawColumns(['project_name','no_of_share','price_per_share','total_amount', 'status'])
                ->make(true);
        }
    }

    public function shareDetails($share_for_sales_id){
        $settings = Settings::first();
        $share_for_sales = ShareForSales::select('*')
            ->selectRaw('share_for_sales.user_id as sfs_id,
            share_for_sales.project_id as sfs_project_id,
            share_for_sales.no_of_shares as sfs_no_of_shares,
            share_for_sales.sold_shares as sfs_sold_shares,
            share_for_sales.amount as sfs_amount,
            share_for_sales.project_report as sfs_project_report')
            ->where('share_for_sales.id',$share_for_sales_id)
            ->get();

        if($share_for_sales[0]->sfs_no_of_shares - $share_for_sales[0]->sfs_sold_shares == 0){
            Session::flash('alert', "All shares has been sold");
            return redirect()->back();
        }
//        $vat = 13 / 100 * $share_for_sales[0]->sfs_amount;
//        $fee = 5 / 100 * $share_for_sales[0]->sfs_amount;
//        $nitaj_fee = 5 / 100 * $share_for_sales[0]->sfs_amount;
//        $total = $share_for_sales[0]->sfs_amount + $vat + $fee + $nitaj_fee;
       $price_per_share = $share_for_sales[0]->sfs_amount / $share_for_sales[0]->sfs_no_of_shares;

        return view('investor.share-for-sale.buy-share-details')
            ->with('share_for_sales',$share_for_sales)
            ->with('price_per_share',$price_per_share)
            ->with('settings',$settings);
    }

    public function placeBid(Request $request){
//        $shares_for_sale = ShareForSales::whereUserId($request->seller_id)->whereProjectId($request->project_id)->first();
        $shares_for_sale = ShareForSales::find($request->share_for_sales_id);
        $data = $request->all();
        $validate_data = [
            'no_of_shares' => [
                'required',
                function ($attribute, $value, $fail) use($shares_for_sale){
                    if($value > $shares_for_sale->no_of_shares){
                        return $fail(__('shares.You cannot enter more than total no of shares'));
                    }
                }
            ],
            'amount' => [
                'required',
                function ($attribute, $value, $fail) use($shares_for_sale, $data){
//                    $vat = 13 / 100 * $shares_for_sale->amount;
//                    $fee = 5 / 100 * $shares_for_sale->amount;
//                    $nitaj_fee = 5 / 100 * $shares_for_sale->amount;
//                    $total =  $shares_for_sale->amount + $vat + $fee + $nitaj_fee;
                    $price_per_share = $shares_for_sale->amount / $shares_for_sale->no_of_shares;
                    $total = $price_per_share * $data['no_of_shares'];
                    if($value < $total){
                        return $fail(__('shares.Entered amount should be greater than').' '.$total);
                    }
                }
            ],
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            if($shares_for_sale->no_of_shares == $shares_for_sale->sold_shares){
                $shares_for_sale->status = 1;
                $shares_for_sale->save();
                return response()->json([
                    'status' => false,
                    'message' => __('shares.All shares has been sold.')
                ], 200);
            }
            if(auth()->user()->id == $request->seller_id){
                return response()->json([
                    'status' => false,
                    'message' => __('shares.You cannot bid on you own share')
                ], 200);
            }
            if(getUserWallet(auth()->user()->id) < $request->amount){
                return response()->json([
                    'status' => false,
                    'message' => __('shares.You don not have enough balance to bid.')
                ], 200);
            }

            $bidding = new Biddings();
            $bidding->bidder_user_id = auth()->user()->id;
            $bidding->seller_user_id = $request->seller_id;
            $bidding->project_id = $request->project_id;
            $bidding->share_for_sales_id = $request->share_for_sales_id;
            $bidding->no_of_shares = $request->no_of_shares;
            $bidding->amount = $request->amount;
            $bidding->status = 2;
            $bidding->save();

            $user = User::findorfail($request->seller_id);
            if($user) {
                $subject = 'Bidding Occurred';
                $details = auth()->user()->fname.' '.auth()->user()->lname.' has bid on your share.';
                \Mail::to($user->email)->send(new \App\Mail\SharesMail($details, $subject));
            }
            return response()->json([
                'status' => true,
                'message' => __('shares.Bid Placed Successfully'),
            ], 200);
        }
    }
}
