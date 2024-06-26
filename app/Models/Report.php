<?php

namespace App\Models;
use App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $fillable = [
        'id',
        'project_id',
        'performance_report_type',
//        'report_type'
    ];

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }

    public function reportDocuments(){
        return $this->hasMany(ReportDocuments::class);
    }

    public function reportProgress(){
        return $this->hasMany(ReportProgress::class, 'report_id', 'id');
    }

    public function reportProgressSummary(){
        return $this->hasOne(ReportProgressSummary::class);
    }
}
