<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MasterProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_number',
        'show',
    ];

    protected $casts = [
        'show' => 'boolean'
    ];
}
