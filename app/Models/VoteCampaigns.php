<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteCampaigns extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }
}
