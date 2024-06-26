<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorInvestments extends Model
{
    use HasFactory;
//    protected $with = ['projects'];

    public function projects()
    {
        return $this->hasOne(Project::class, 'id', 'project_id')->with('reports','fundingCampaigns');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
    public function userWalletLogs()
    {
        return $this->hasMany(WalletLogs::class, 'project_id', 'project_id')->where('user_id', auth()->user()->id);
    }
}
