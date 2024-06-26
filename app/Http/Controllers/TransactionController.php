<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\UserWallets;
use App\Models\WalletLogs;
use App\Models\WithdrawRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = WithdrawRequests::select('*')->orderBy('created_at', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at));
                })
                ->addColumn('transaction_type', function ($row) {
                    return ucfirst($row->transaction_type);
                })
                ->addColumn('amount', function ($row) {
                    return $row->amount . ' SAR';
                })
                ->addColumn('user_id', function ($row) {
                    $user = $this->getUser($row->user_id);
                    return '<a class="color-green" href="'.route('admin.investor.view',$row->user_id).'">'.$user->fname . ' ' . $user->lname.'</a>';

                })
                ->addColumn('action', function ($row) {
                    if($row->transaction_type == 'cashout'){
                        if ($row->status == 0) {
                            $status_div = '<a href="' . route('admin.transaction.statusChange', [$row->id, 1]) . '" class="new-campaign-button-active">Approve</a>
                                        <a href="' . route('admin.transaction.statusChange', [$row->id, -1]) . '" class="new-campaign-button-view">Reject</a>';
                        } elseif($row->status == 1){
                            $status_div = '<a href="javascript:;" class="new-campaign-button-active">Approved</a>';
                        } else{
                            $status_div = '<a href="' . route('admin.transaction.statusChange', [$row->id, 1]) . '" class="new-campaign-button-view">Rejected</a>';
                        }
                        $btn = '<div class="group-buttons categories-progress-view">
                                '.$status_div.'
                              </div>';

                        return $btn;
                    }
                })
                ->rawColumns(['action','user_id','amount','transaction_type','created_at'])
                ->make(true);
        }
    }

    public function transactionList()
    {
        return view('admin.transactions.transaction');
    }

    public function transactionStatusChange($id, $status)
    {
        $withdraw_request = WithdrawRequests::find($id);
        $withdraw_request->status = $status;
        $withdraw_request->save();

        $user_wallet = UserWallets::whereUserId($withdraw_request->user_id)->first();
        $user_wallet->deducted_amount = $user_wallet->deducted_amount + $withdraw_request->amount;
        $user_wallet->save();

        $wallet_log = new WalletLogs();
        $wallet_log->user_id = auth()->user()->id;
        $wallet_log->amount = $withdraw_request->amount;
        $wallet_log->type = 'credit';
        $wallet_log->save();
        $activity = [
            'user_id' => $withdraw_request->user_id,
            'title' => 'Withdraw Request',
            'project_id' => '',
            'vote_campaign_id' => '',
            'type' => 'withdraw_request'
        ];
        recentActivity($activity);

        Session::flash('success', "Status Changed Successfully!");
        return redirect()->back();
    }
}
