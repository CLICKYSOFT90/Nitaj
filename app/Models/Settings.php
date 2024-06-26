<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'id',
        'vat',
        'withdrawal_fee',
        'fee',
        'service_fee',
        'nitaj_exit_fee'
    ];
}
