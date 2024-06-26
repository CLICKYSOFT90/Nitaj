<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FundingCampaigns;
use App\Models\InvestorInvestments;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Notifications::select('*')
                ->addSelect('notifications.id as noti_id')
                ->join('users', 'users.id','=', 'notifications.to')
                ->join('projects', 'projects.id','=', 'notifications.project_id')
                ->whereCreatedBy(1)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('id', function ($row) {
                    return $row->noti_id;
                })
                ->addColumn('subject', function ($row) {
                    return $row->subject;
                })
                ->addColumn('purpose', function ($row) {
                    return $row->purpose;
                })
                ->addColumn('to', function ($row) {
                    return $row->fname.' '.$row->lname;
                })
                ->addColumn('project_name', function ($row) {
                    return $row->project_name_en;
                })
                ->addColumn('text', function ($row) {
                    return $row->description;
                })
                ->rawColumns(['subject','purpose', 'to', 'project_name', 'text'])
                ->make(true);
        }
    }

    public function notifications(){
        $users = User::whereIsAdmin(0)->get();
        $projects = FundingCampaigns::all();
        return view('admin.notifications.notifications')
            ->with('users', $users)
            ->with('projects', $projects);
    }
    public function postNotifications(Request $request){
        $validate_data = [
            'subject' => 'required|max:50',
            'purpose' => 'required|max:50',
            'to' => 'required',
            'project_name' => 'required',
            'desc' => 'required',
        ];

        $validator = Validator::make($request->all(),$validate_data);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $notifications = new Notifications();
            $notifications->subject = $request->subject;
            $notifications->purpose = $request->purpose;
            $notifications->to = $request->to;
            $notifications->project_id = $request->project_name;
            $notifications->description = $request->desc;
            $notifications->created_by = 1;
            $notifications->save();
            Session::flash('success', "Notification Send Successfully!");
            return redirect()->back();
        }
    }

    public function getProjectInvestors(Request $request){
        $option = '';
        $investor_invested = InvestorInvestments::whereProjectId($request->project_id)->with('users')->get();
        foreach ($investor_invested as $user) {
            foreach ($user->users as $investor) {
                $option .= '<option value="' . $investor->id . '">' . $investor->fname . '</option>';
            }
        }
        return response()->json([
            'status' => true,
            'data' => $option,
        ]);
    }
}
