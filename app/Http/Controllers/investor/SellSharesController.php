<?php

namespace App\Http\Controllers\investor;

use App\Http\Controllers\BaseController;
use App\Models\Biddings;
use App\Models\InvestorInvestments;
use App\Models\Settings;
use App\Models\ShareForSales;
use App\Models\SharesLogs;
use App\Models\User;
use App\Models\UserWallets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SellSharesController extends BaseController
{
    public function getsellShares()
    {
        return view('investor.share-for-sale.sell-share');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ShareForSales::select('*')
                ->addSelect('share_for_sales.id as sfs_id')
                ->join('projects', 'share_for_sales.project_id', '=', 'projects.id')
                ->where('share_for_sales.user_id', auth()->user()->id)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->sfs_id;
                })
                ->addColumn('project_name', function ($row) {
                    return App::getLocale() == 'en' ? $row->project_name_en : $row->project_name_ar;
                })
                ->addColumn('no_of_share', function ($row) {
                    return $row->no_of_shares - $row->sold_shares;
                })
                ->addColumn('price_per_share', function ($row) {
                    return $row->amount / $row->no_of_shares;
                })
                ->rawColumns(['project_name', 'no_of_share', 'price_per_share'])
                ->make(true);
        }
    }

    public function bidOfferList(Request $request)
    {
        if ($request->ajax()) {
            $bid_list = Biddings::select('*')
                ->addSelect('biddings.status as b_status', 'biddings.id as b_id')
                ->join('projects', 'biddings.project_id', '=', 'projects.id')
                ->where('biddings.seller_user_id', auth()->user()->id)
                ->get();
            return Datatables::of($bid_list)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->share_for_sales_id;
                })
                ->addColumn('bidder', function ($row) {
                    $user = $this->getUser($row->bidder_user_id);
                    return $user->fname . ' ' . $user->lname;
                })
                ->addColumn('no_of_share', function ($row) {
                    return $row->no_of_shares;
                })
                ->addColumn('price_per_share', function ($row) {
                    return $row->amount / $row->no_of_shares;
                })
                ->addColumn('value', function ($row) {
                    return $row->amount;
                })
                ->addColumn('action', function ($row) {
                    if ($row->b_status == 1) {
                        $div = '<a href="javascript:;" class="buy-accept-btn">' . __('shares.Accepted') . '</a>';
                    } else if ($row->b_status == 2) {
                        $div = '<a href="javascript:;" class="buy-accept-btn" onclick="changeStatus(' . $row->b_id . ',1,' . $row->project_id . ',' . $row->seller_user_id . ', this)">' . __('shares.Accept') . '</a>
                                <a href="javascript:;" class="buy-rejected-btn" onclick="changeStatus(' . $row->b_id . ',0,' . $row->project_id . ',' . $row->seller_user_id . ', this)">' . __('shares.Reject') . '</a>';
                    } else {
                        $div = '<a href="javascript:;" class="buy-rejected-btn">' . __('shares.Rejected') . '</a>';
                    }
                    return '<div class="group-buttons">
                                ' . $div . '
                            </div>';
                })
                ->rawColumns(['bidder', 'no_of_share', 'price_per_share', 'value', 'action'])
                ->make(true);
        }
    }

    public function sellShares()
    {
        $settings = Settings::first();
        if (isset($_GET['id'])) {
            $data['investment'] = InvestorInvestments::select('*')
                ->addSelect(DB::raw("(no_of_shares - sold_shares) as total_shares"))
                ->whereUserId(auth()->user()->id)
                ->whereProjectId($_GET['id'])
                ->first();
        }
        $data['projects'] = InvestorInvestments::selectRaw('*,(no_of_shares - sold_shares) as total_shares')
            ->whereUserId(auth()->user()->id)
            ->whereStatus(1)
            ->whereAdminApproved(1)
            ->having('total_shares','>',0)
            ->get();
        return view('investor.share-for-sale.share-info')
            ->with('data', $data)
            ->with('settings', $settings);
    }

    public function postSellShares(Request $request)
    {

        $investment = InvestorInvestments::select('*')
            ->addSelect(DB::raw("(no_of_shares - sold_shares) as total_shares"))
            ->whereUserId(auth()->user()->id)
            ->whereProjectId($request->project_id)
            ->first();
        $validate_data = [
            'no_of_shares' => [
                'required',
                function ($attribute, $value, $fail) use ($investment) {
                    if ($value > $investment->total_shares) {
                        return $fail(__('shares.You cannot enter more than total no of shares'));
                    }
                }
            ],
            'price_per_share' => 'required',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $share_sale = new ShareForSales();
            if ($request->hasFile('project_report')) {
                $fileName = time() . rand(1, 50) . '.' . $request->project_report->extension();
                $request->project_report->move(public_path('investor-project-report'), $fileName);
                $share_sale->project_report = $fileName;
            }
            $share_sale->user_id = auth()->user()->id;
            $share_sale->project_id = $request->project_id;
            $share_sale->no_of_shares = $request->no_of_shares;
            $share_sale->amount = $request->price_per_share;
            $share_sale->save();
            Session::flash('success', __('shares.Request for sale share is successful!'));
            return redirect()->route('investor.sell.shares');
        }
    }

    public function changeStatusBidding(Request $request)
    {
        $bidding = Biddings::find($request->id);
        $settings = Settings::first();
        if ($request->status == 1) {
            $share_for_sale = ShareForSales::findorfail($bidding->share_for_sales_id);
            if ($share_for_sale->no_of_shares == $share_for_sale->sold_shares) {
                $share_for_sale->status = 1;
                $share_for_sale->save();
                return response()->json([
                    'status' => false,
                    'error' => __('shares.All shares has been sold.')
                ], 200);
            }
            $share_for_sale->sold_shares = $bidding->no_of_shares + $share_for_sale->sold_shares;
            $share_for_sale->save();
            if ($share_for_sale->no_of_shares == $share_for_sale->sold_shares) {
                $share_for_sale->status = 1;
                $share_for_sale->save();
            }

            $investor_investment = InvestorInvestments::whereUserId($request->seller_id)->whereProjectId($request->project_id)->first();
            $investor_investment->sold_shares = $investor_investment->sold_shares + $bidding->no_of_shares;
            $investor_investment->save();

            //Calculate Nitaj Fees
            $vat = $settings->vat / 100 * $bidding->amount;
            $fee = $settings->fee / 100 * $bidding->amount;
            $nitaj_fee = $settings->nitaj_exit_fee / 100 * $bidding->amount;
            $total_with_fee = $bidding->amount + $vat + $fee + $nitaj_fee;

            $investor_exist = InvestorInvestments::whereUserId($bidding->bidder_user_id)
                            ->whereProjectId($bidding->project_id)
                            ->first();
            if($investor_exist){
//                $investor_exist->amount_invested = $investor_exist->amount_invested + $total_with_fee;
                $investor_exist->amount_invested = $bidding->aomunt;
                $investor_exist->no_of_shares = $investor_exist->no_of_shares + $bidding->no_of_shares;
                $investor_exist->save();
            } else {
                $bidder_investment = new InvestorInvestments();
                $bidder_investment->user_id = $bidding->bidder_user_id;
                $bidder_investment->project_id = $bidding->project_id;
//                $bidder_investment->amount_invested = $total_with_fee;
                $bidder_investment->amount_invested = $bidding->aomunt;
                $bidder_investment->no_of_shares = $bidding->no_of_shares;
                $bidder_investment->sold_shares = 0;
                $bidder_investment->status = 1;
                $bidder_investment->admin_approved = 1;
                $bidder_investment->save();
            }

            $share_logs = new SharesLogs();
            $share_logs->seller_user_id = $bidding->seller_user_id;
            $share_logs->buyer_user_id = $bidding->bidder_user_id;
            $share_logs->project_id = $bidding->project_id;
            $share_logs->share_for_sale_id = $bidding->share_for_sales_id;
            $share_logs->no_of_shares = $bidding->no_of_shares;
            $share_logs->amount = $bidding->amount;
            $share_logs->status = 1;
            $share_logs->save();

            // Deduction from Bidder's Wallet
            $bidder_wallet = UserWallets::whereUser_id($bidding->bidder_user_id)->first();
            $bidder_wallet->deducted_amount = $bidder_wallet->deducted_amount + $total_with_fee;
            $bidder_wallet->save();

            // Adding to Seller's Wallet
            $bidder_wallet = UserWallets::whereUser_id($bidding->seller_user_id)->first();
            $bidder_wallet->added_amount = $bidder_wallet->added_amount + $bidding->amount;
            $bidder_wallet->save();
        }
        $bidding->status = $request->status;
        $bidding->save();
        $user = User::findorfail($bidding->bidder_user_id);
        if ($user) {
            $subject = 'Status Of Bid';
            $details = $request->status == 1 ? auth()->user()->fname . ' ' . auth()->user()->lname . ' has accepted your bid.' : auth()->user()->fname . ' ' . auth()->user()->lname . ' has rejected your bid.';
            \Mail::to($user->email)->send(new \App\Mail\SharesMail($details, $subject));
        }

        return response()->json([
            'status' => true,
            'error' => __('shares.Status Change Successfully.')
        ], 200);
    }
}
