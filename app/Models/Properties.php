<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_code',
        'show_product',
        'show_currency',
        'footer_flow'
    ];
}
