<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UpgradeToPro extends BaseController
{
    public function index()
    {
        return view('investor.upgrade-to-pro.pro');
    }

    public function postPro(Request $request)
    {
        $validate_data = [
            'made_transactions' => 'required|mimes:pdf,jpg,jpeg,png',
            'net_assets' => 'required|mimes:pdf,jpg,jpeg,png',
            'worked_previously' => 'required|mimes:pdf,jpg,jpeg,png',
            'pro_certificate' => 'required|mimes:pdf,jpg,jpeg,png',
            'trading_certificate' => 'required|mimes:pdf,jpg,jpeg,png',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($request->hasFile('made_transactions')) {
                $data['1'] = time() . rand(1, 50) . '.' . $request->made_transactions->extension();
                $request->made_transactions->move(public_path('made-transactions'), $data['1']);
            }
            if ($request->hasFile('net_assets')) {
                $data['2'] = time() . rand(1, 50) . '.' . $request->net_assets->extension();
                $request->net_assets->move(public_path('net-assets'), $data['2']);
            }
            if ($request->hasFile('worked_previously')) {
                $data['3'] = time() . rand(1, 50) . '.' . $request->worked_previously->extension();
                $request->worked_previously->move(public_path('worked-previously'), $data['3']);
            }
            if ($request->hasFile('pro_certificate')) {
                $data['4'] = time() . rand(1, 50) . '.' . $request->pro_certificate->extension();
                $request->pro_certificate->move(public_path('pro-certificate'), $data['4']);
            }
            if ($request->hasFile('trading_certificate')) {
                $data['5'] = time() . rand(1, 50) . '.' . $request->trading_certificate->extension();
                $request->trading_certificate->move(public_path('trading-certificate'), $data['5']);
            }
            $pro = new \App\Models\UpgradeToPro();
            $pro->user_id = auth()->user()->id;
            $pro->made_transactions = $data['1'];
            $pro->net_assets = $data['2'];
            $pro->worked_previously = $data['3'];
            $pro->pro_certificate = $data['4'];
            $pro->trading_certificate = $data['5'];
            $pro->save();

            $data[] = [
                'to' => 1,
                'subject' => 'Upgrade To Pro',
                'purpose' => 'Upgrade To Pro Request',
                'desc' => auth()->user()->fname . ' ' . auth()->user()->lname . ' has requested for upgrade to pro',
                'type' => 'upgrade_to_pro'
            ];
            $this->notification($data);

            Session::flash('success', __('upgrade-to-pro.Request has been sent to admin'));
            return redirect()->back();
        }
    }

    public function proView()
    {
        return view('admin.upgrade-to-pro.upgrade-to-pro');
    }

    public function proList(Request $request)
    {
        if ($request->ajax()) {
            $data = \App\Models\UpgradeToPro::Select('*')
                ->addSelect('upgrade_to_pros.status as pro_status', 'upgrade_to_pros.id as pro_id')
                ->join('users', 'users.id', '=', 'upgrade_to_pros.user_id')
                ->orderBy('upgrade_to_pros.created_at', 'DESC')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('user', function ($row) {
                    return $row->fname . ' ' . $row->lname;
                })
                ->addColumn('made_transactions', function ($row) {
                    return '<a href="'.asset('made-transactions/'.$row->made_transactions).'" target="_blank">'.$row->made_transactions.'</a>
                            <a href="'.asset('made-transactions/'.$row->made_transactions).'" download><i class="fa fa-download"></i> </a>';
                })
                ->addColumn('net_assets', function ($row) {
                    return '<a href="'.asset('net-assets/'.$row->net_assets).'" target="_blank">'.$row->net_assets.'</a>
                            <a href="'.asset('net-assets/'.$row->net_assets).'" download><i class="fa fa-download"></i> </a>';
                })
                ->addColumn('worked_previously', function ($row) {
                    return '<a href="'.asset('worked-previously/'.$row->worked_previously).'" target="_blank">'.$row->worked_previously.'</a>
                            <a href="'.asset('worked-previously/'.$row->worked_previously).'" download><i class="fa fa-download"></i> </a>';
                })
                ->addColumn('pro_certificate', function ($row) {
                    return '<a href="'.asset('pro-certificate/'.$row->pro_certificate).'" target="_blank">'.$row->pro_certificate.'</a>
                            <a href="'.asset('pro-certificate/'.$row->pro_certificate).'" download><i class="fa fa-download"></i> </a>';
                })
                ->addColumn('trading_certificate', function ($row) {
                    return '<a href="'.asset('trading-certificate/'.$row->trading_certificate).'" target="_blank">'.$row->trading_certificate.'</a>
                            <a href="'.asset('trading-certificate/'.$row->trading_certificate).'" download><i class="fa fa-download"></i> </a>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->pro_status == 2) {
                        $btn = '<div class="group-buttons categories-progress-view">
                                    <a href="javascript:;" class="new-campaign-button-active">No Action Performed</a>
                                  </div>';
                        return $btn;
                    }
                    $class = $row->pro_status == 1 ? 'new-campaign-button-active' : 'new-campaign-button-view';
                    $content = $row->pro_status == 1 ? 'Accepted' : 'Declined';
                    $btn = '<div class="group-buttons categories-progress-view">
                                    <a href="javascript:;" class="'.$class.'">'.$content.'</a>
                                  </div>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    if ($row->pro_status == 1) {
                        $btn = '<div class="group-buttons categories-progress-view">
                                    <a href="javascript:;" class="new-campaign-button-view" onclick="changeStatus('.$row->pro_id.',0)">Decline</a>
                                  </div>';
                    } else {
                        $btn = '<div class="group-buttons categories-progress-view">
                                    <a href="javascript:;" class="new-campaign-button-active" onclick="changeStatus('.$row->pro_id.',1)" >Accept</a>
                                  </div>';
                    }
                    return $btn;
                })
                ->rawColumns(['user', 'made_transactions', 'net_assets', 'worked_previously', 'pro_certificate', 'trading_certificate', 'status', 'action'])
                ->make(true);
        }
    }

    public function proStatus(Request $request)
    {
        $pro = \App\Models\UpgradeToPro::findorfail($request->id);
        $pro->status = $request->status;
        $pro->save();
        $user = User::findorfail($pro->user_id);
        $user->type = $request->status;
        $user->save();
        return response()->json([
            'status' => true,
            'error' => "Status Changed Successfully",
        ], 200);
    }
}
