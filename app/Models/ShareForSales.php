<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareForSales extends Model
{
    use HasFactory;

    protected $with = ['project'];

    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }
    public function bidding()
    {
        return $this->hasMany(Biddings::class, 'share_for_sales_id', 'id');
    }
}
