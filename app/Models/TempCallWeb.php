<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempCallWeb extends Model
{
    protected $table = 'temp_call_web';

    public function scopelistNewest(Builder $query): void
    {
        $query->orderBy('id', 'desc');
    }

    public function scopelistOldest(Builder $query): void
    {
        $query->orderBy('id', 'asc');
    }

    public function scopenotCalled(Builder $query): void
    {
        $query->where('Tampil', 'n');
    }

    public function scopedoneCalled(Builder $query): void
    {
        $query->where('Tampil', 'y');
    }

    use HasFactory;

    protected $fillable = [
        'Tampil',
        'Counter',
        'Unit',
        'SeqNumber',
        'button_actor_id'
    ];
}
