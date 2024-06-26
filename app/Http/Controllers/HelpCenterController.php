<?php

namespace App\Http\Controllers;

use App\Models\RecentActivities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\HelpCenter;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;

class HelpCenterController extends Controller
{
    public function helpCenter(Request $request)
    {

        // if admin
        if (auth()->user()->is_admin) {

            if ($request->ajax()) {
                $data = HelpCenter::all();
                return Datatables::of($data)
                    ->addColumn('action', function ($row) {

                        $btn = '<div class="group-buttons categories-progress-view">
                                <a href="' . route('admin.help-center.edit', $row->id) . '" class="new-campaign-button-view">Action</a>
                              </div>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.help-center.help-center');
        }

        // if investor
        $complaints = HelpCenter::where('user_id', auth()->user()->id)->get();
        return view('investor.help-center.help-center', compact('complaints'));
    }

    public function submit(Request $request)
    {

        $validate_data = [
            'user_id' => 'required',
            'subject' => 'required|min:5|max:15',
            'importance' => 'required',
            'description' => 'required|min:5|max:500',
        ];

        $validator = Validator::make($request->all(), $validate_data);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {

            HelpCenter::create($request->except(['_token']));
            $complainer = User::where('id', auth()->user()->id)->first();
            $details = [
                'f_name' => $complainer->fname,
                'l_name' => $complainer->lname,
                'subject' => $request->subject,
                'importance' => $request->importance,
                'description' => $request->description,
            ];

            //Adding in recent activity
            $activity = [
                'user_id' => 1,
                'title' => 'Complaint Received',
                'type' => 'complaint'
            ];
            RecentActivities::insert($activity);

            $admin = User::where('is_admin', 1)->first()->email;
            \Mail::to($admin)->send(new \App\Mail\ComplaintMail($details));
            Session::flash('success', "Complaint has been sent!");
            return redirect()->route('investor.help-center');

        }
    }

    public function action($id)
    {

        // only admin
        $complaint = HelpCenter::where('id', $id)->with('user')->firstOrFail();
        return view('admin.help-center.action', compact('complaint'));
    }

    public function update(Request $request)
    {

        // only admin
        $complaint = HelpCenter::where('id', $request->id)->firstOrFail();
        $previous_status = $complaint->status;
        $complaint->update($request->except(['_token', '_method']));

        if ($previous_status != $request->status) {
            $details = [
                'status' => $complaint->status,
                'subject' => $complaint->subject
            ];
            $investor = User::where('id', $complaint->user_id)->firstOrFail()->email;
            try {
                \Mail::to($investor)->send(new \App\Mail\ComplaintStatus($details));
                Session::flash('success', "Complaint has been sent!");
                return redirect()->route('admin.help-center');
            } catch (\Exception $e) {
                Session::flash('alert', "Email not sent!");
                return redirect()->route('admin.help-center');
            }
        }
        return redirect()->route('admin.help-center');

    }

    public function delete(Request $request)
    {

        $complaint = HelpCenter::where('id', $request->complaint_id)->delete();
        if ($complaint) {
            return response()->json([
                'status' => true,
                'error' => "Complaint Deleted Successfully",
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'error' => "Oops! Something went wrong.",
            ], 200);
        }
    }


}
