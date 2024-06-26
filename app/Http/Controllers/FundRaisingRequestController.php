<?php

namespace App\Http\Controllers;

use App\Models\FundingRequests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FundRaisingRequestController extends Controller
{
    public function fundRequest(){
        return view('fund-raising-request');
    }
    public function fundRequestList(){
        return view('admin.fund-request.fundRequest');
    }
    public function viewFundRequest($id){
        $funding_request = FundingRequests::findorfail($id);
        return view('admin.fund-request.viewfundRequest')->with('funding_request', $funding_request);
    }
    public function fundRequestStatus(Request $request){
        $fund_request = FundingRequests::find($request->id);
        $fund_request->status = $request->status;
        $fund_request->save();
        if($request->status == 1){
            $details = [
                'status' => 'Your fund raise request has been approved by Nitaj Crowd Funding'
            ];
        } else{
            $details = [
                'status' => 'Your fund raise request has been rejected by Nitaj Crowd Funding'
            ];
        }
        \Mail::to($fund_request->email)->send(new \App\Mail\FundRequestMail($details));
        return response()->json([
            'status' => true,
            'error' => "Status Changed Successfully",
        ], 200);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FundingRequests::select('*')->orderBy('created_at', 'DESC');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at));
                })
                ->addColumn('status', function ($row) {
                    $class = !is_null($row->status) ? ($row->status == 1 ? 'new-campaign-button-active' : 'new-campaign-button-view new-campaign-button-grey') : "";
                    $content = !is_null($row->status) ? ($row->status == 1 ? 'Approved' : 'Rejected') : '';
                    return '<div class="group-buttons categories-progress-view text-left">
                                <a href="javascript:;" class="'.$class.'">'.$content.'</a>
                              </div>';
                })
                ->addColumn('action', function ($row) {
                    if(is_null($row->status)){
                        $div = '<a href="javascript:;" onclick="changeStatus('.$row->id.',1)" class="new-campaign-button-active">Accept</a>
                                <a href="javascript:;" onclick="changeStatus('.$row->id.',0)" class="new-campaign-button-active new-campaign-button-grey">Reject</a>';
                    } else{
                        $div = '';
                    }
                    $div = '<div class="group-buttons categories-progress-view text-left">
                                <a href="'.route('admin.fund-request.view', $row->id).'" class="new-campaign-button-view">View</a>
                                '.$div.'
                            </div>';
                    return $div;
                })
                ->rawColumns(['created_at', 'status', 'action'])
                ->make(true);
        }
    }

    public function addFundRequest(Request $request)
    {
        $validate_data = [
            'investor_type' => 'required',
            'occupation' => 'required',
            'company_name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'unit_no' => 'required',
            'street' => 'required',
            'district' => 'required',
            'city' => 'required',
            'country' => 'required',
            'zip_code' => 'required',
            'project_type' => 'required',
            'asset_type' => 'required',
            'land_status' => 'required',
            'location' => 'required',
            'project_details' => 'required',
            'profile_attachment' => 'required',
            'project_doc_attachment' => 'required',
            'amount' => 'required|integer',

            'funding_structure' => 'required',
            'proj_value' => 'required',
            'cap_contribute' => 'required',
            'loan_liability' => 'required',
            'fundraising_required' => 'required',
            'need_capital' => 'required',
            'expected_roi' => 'required',
            'expected_dividends' => 'required',
            'valuations' => 'required|mimes:pdf',
            'cr' => 'required|mimes:pdf',
            'feasibility_status' => 'required|mimes:pdf',
        ];

        $validator = Validator::make($request->all(), $validate_data);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $funding_request = new FundingRequests();
            if ($request->hasFile('profile_attachment')) {
                $fileName = time() . rand(1, 50) . '.' . $request->profile_attachment->extension();
                $request->profile_attachment->move(public_path('funding-request/profile_attachment'), $fileName);
                $funding_request->profile_attachment = $fileName;
            }
            if ($request->hasFile('project_doc_attachment')) {
                $fileName = time() . rand(1, 50) . '.' . $request->project_doc_attachment->extension();
                $request->project_doc_attachment->move(public_path('funding-request/project_doc_attachment'), $fileName);
                $funding_request->project_doc_attachment = $fileName;
            }
            if ($request->hasFile('valuations')) {
                $fileName = time() . rand(1, 50) . '.' . $request->valuations->extension();
                $request->valuations->move(public_path('funding-request/valuations'), $fileName);
                $funding_request->valuations = $fileName;
            }
            if ($request->hasFile('cr')) {
                $fileName = time() . rand(1, 50) . '.' . $request->cr->extension();
                $request->cr->move(public_path('funding-request/cr'), $fileName);
                $funding_request->cr = $fileName;
            }
            if ($request->hasFile('feasibility_status')) {
                $fileName = time() . rand(1, 50) . '.' . $request->feasibility_status->extension();
                $request->feasibility_status->move(public_path('funding-request/feasibility_status'), $fileName);
                $funding_request->feasibility_status = $fileName;
            }

            $funding_request->amount = $request->amount;
            $funding_request->investor_type = $request->investor_type;
            $funding_request->occupation = $request->occupation;
            $funding_request->company_name = $request->company_name;
            $funding_request->email = $request->email;
            $funding_request->contact = $request->contact;
            $funding_request->unit_no = $request->unit_no;
            $funding_request->street = $request->street;
            $funding_request->district = $request->district;
            $funding_request->city = $request->city;
            $funding_request->country = $request->country;
            $funding_request->zip_code = $request->zip_code;
            $funding_request->company_cr = $request->company_cr;
            $funding_request->project_type = $request->project_type;
            $funding_request->asset_type = $request->asset_type;
            $funding_request->land_status = $request->land_status;
            $funding_request->location = $request->location;
            $funding_request->project_details = $request->project_details;
            $funding_request->funding_structure = $request->funding_structure;
            $funding_request->proj_value = $request->proj_value;
            $funding_request->cap_contribute = $request->cap_contribute;
            $funding_request->loan_liability = $request->loan_liability;
            $funding_request->fundraising_required = $request->fundraising_required;
            $funding_request->need_capital = $request->need_capital;
            $funding_request->expected_roi = $request->expected_roi;
            $funding_request->expected_dividends = $request->expected_dividends;
            $funding_request->save();
            $admin = User::where('is_admin', 1)->first();
            $details = [
                'status' => 'You have a new fund raising request.'
            ];
            \Mail::to($admin->email)->send(new \App\Mail\FundRequestMail($details));
            Session::flash('success', "Funding Request Sent Successfully!");
            return redirect()->back();
        }
    }
}
