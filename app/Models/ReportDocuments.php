<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDocuments extends Model
{
    use HasFactory;

    protected $table = 'report_documents';

    protected $fillable = [
        'id',
        'report_id',
        'prospectus',
        'file_name',
        'file_path'
    ];
}
