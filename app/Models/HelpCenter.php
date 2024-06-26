<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class HelpCenter extends Model
{
    use HasFactory;

    protected $table = 'help_center';

    protected $fillable = [
        'id',
        'user_id',
        'subject',
        'importance',
        'description'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
