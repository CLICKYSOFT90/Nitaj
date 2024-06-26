<?php

namespace App\Http\Controllers;

use App\Models\FundingRequests;
use App\Models\Settings;
use App\Models\Transactions;
use App\Models\WithdrawRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class WalletController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transactions::select('*')->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('transaction_id', function ($row) {
                    if(!empty($row->transaction_id)){
                        return $row->transaction_id;
                    } else{
                        return '-';
                    }
                })
                ->addColumn('description', function ($row) {
                    if($row->transaction_type !== 'withdrawal'){
                        $project = $this->getProject($row->project_id);
                        return $project->project_name_en;
                    } else{
                        return '-';
                    }
                })
                ->addColumn('transaction_type', function ($row) {
                    return ucfirst($row->transaction_type);
                })
                ->addColumn('amount', function ($row) {
                    return number_format($row->amount) . ' SAR';
                })
                ->addColumn('bank_account', function ($row) {
                    return '-';
                })
                ->addColumn('status', function ($row) {
                    if($row->transaction_type == 'withdrawal'){
                        if ($row->status == 1) {
                            $status_div = '<button type="button" class="buy-completed-btn">Completed</button>';
                        } elseif ($row->status == -1) {
                            $status_div = '<button type="button" class="buy-pending-btn" style="color: red;">Rejected</button>';
                        } else {
                            $status_div = '<button type="button" class="buy-pending-btn">Pending</button>';
                        }
                        return '<div class="group-buttons">
                            ' . $status_div . '
                            </div>';
                    } else{
                            $status_div = '<button type="button" class="buy-completed-btn">Completed</button>';
                            return '<div class="group-buttons">
                                ' . $status_div . '
                                </div>';
                    }

                })
                ->rawColumns(['description', 'amount', 'status'])
                ->make(true);
        }
    }

    public function wallet()
    {
        $wallet_requests = WithdrawRequests::whereUserId(auth()->user()->id)
            ->whereStatus(1)
            ->whereConfirm(1)
            ->whereTransactionType('cashout')
            ->sum('amount');
        $pending_requests = WithdrawRequests::whereUserId(auth()->user()->id)
            ->whereStatus(0)
            ->whereConfirm(1)
            ->whereTransactionType('cashout')
            ->sum('amount');
        return view('investor.wallet.wallet')
            ->with('wallet_requests', $wallet_requests)
            ->with('pending_requests', $pending_requests);
    }

    public function postWithdrawRequest(Request $request)
    {
        $validate_data = [
            'bank_acc' => 'required',
            'wallet_type' => 'required',
            'amount' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        } else {
            $settings = Settings::first();
            $funding_request = new WithdrawRequests();
            $data['amount'] = $request->amount;
            // VAT
            $data['vat'] = $settings->vat / 100 * $request->amount;
            $data['fee'] = $settings->fee / 100 * $request->amount;
            $data['withdraw_fee'] = $settings->nitaj_exit_fee / 100 * $request->amount;
            $data['total'] = $request->amount - $data['vat'] - $data['fee'] - $data['withdraw_fee'];
            $transaction_id = \Str::random(10) . auth()->user()->id;
            $funding_request->user_id = auth()->user()->id;
            $funding_request->transaction_id = $transaction_id;
            $funding_request->bank_account = $request->bank_acc;
            $funding_request->wallet_type = $request->wallet_type;
            $funding_request->amount = $data['total'];
            $funding_request->transaction_type = 'cashout';
            $funding_request->status = 0;
            $funding_request->save();
            $data['id'] = $funding_request->id;

            $data['bank'] = "ANB Bank";

            // Logging in transactions Table
            $transactions = new Transactions();
            $transactions->transaction_type = 'withdrawal';
            $transactions->user_id = auth()->user()->id;
            $transactions->project_id = 0;
            $transactions->amount = $request->amount;
            $transactions->transaction_id = $transaction_id;
            $transactions->save();

            return response()->json([
                'status' => true,
                'data' => $data,
            ], 200);
        }
    }

    public function postWithdrawRequestConfirm(Request $request)
    {
        $funding_request = WithdrawRequests::find($request->id);
        $funding_request->confirm = 1;
        $funding_request->save();
        return response()->json([
            'status' => true,
            'data' => $funding_request,
        ], 200);
    }
}
