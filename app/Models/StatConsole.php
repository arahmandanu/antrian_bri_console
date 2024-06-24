<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatConsole extends Model
{
    use HasFactory;

    protected $table = 'stat_console';

    protected $fillable = [
        'tanggal',
        'Status',
        'ActiveDate',
    ];
}
