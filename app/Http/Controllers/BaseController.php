<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function getUser($user_id){
        $user = User::find($user_id);
        return $user;
    }
    public function getProject($project_id){
        $project = Project::find($project_id);
        return $project;
    }
    public function notification(array $data){
        foreach($data as $notify) {
            $notification = new Notifications();
            $notification->subject = $notify['subject'] ?? '';
            $notification->purpose = $notify['purpose'] ?? '';
            $notification->to = $notify['to'] ?? null;
            $notification->description = $notify['desc'] ?? '';
            $notification->type = $notify['type'] ?? '';
            $notification->project_id = $notify['project'] ?? '';
            $notification->save();
        }
    }
}
