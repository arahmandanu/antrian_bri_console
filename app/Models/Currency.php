<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public const FLAG_PATH = 'flag/';

    protected $table = 'currency';

    use HasFactory;

    protected $fillable = [
        'flag_url',
        'name',
        'jual_a',
        'jual_b',
        'beli_a',
        'beli_b',
        'show',
    ];
}
