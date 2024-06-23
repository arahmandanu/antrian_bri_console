<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempCallWeb extends Model
{
    public $timestamps = false;

    protected $table = 'temp_call_web';

    public function scopelistNewest(Builder $query): void
    {
        $query->orderBy('id', 'desc');
    }

    use HasFactory;

    protected $fillable = [
        'Tampil',
        'Counter',
        'Unit',
        'SeqNumber'
    ];
}
