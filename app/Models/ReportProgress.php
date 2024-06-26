<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportProgress extends Model
{
    use HasFactory;

    protected $table = 'report_progress';

    protected $fillable = [
        'id',
        'report_id',
        'progress_type',
        'progress_percentage',
        'date',
        'image_name',
        'image_path'
    ];
}
