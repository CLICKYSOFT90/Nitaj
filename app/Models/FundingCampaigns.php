<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundingCampaigns extends Model
{
    use HasFactory;
    protected $with = ['campaign_phase', 'projects'];

    public function campaign_phase()
    {
        return $this->hasMany(FundingPhase::class, 'funding_campaign_id', 'id');
    }
    public function projects()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }
}
