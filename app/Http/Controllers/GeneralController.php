<?php

namespace App\Http\Controllers;

use App\Models\FundingCampaigns;
use Illuminate\Http\Request;

class GeneralController extends BaseController
{
    public function index(){
        $projects = FundingCampaigns::whereStatus('1')->limit(3)->get();
        return view('welcome')->with('projects', $projects);
    }
}
