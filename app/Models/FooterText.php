<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterText extends Model
{
    use HasFactory;

    public function scopeShow(Builder $query): void
    {
        $query->where('show', true)->orderBy('display_number', 'asc');
    }

    public function scopeConsole(Builder $query): void
    {
        $query->where('type', 'console');
    }

    public function scopeKios(Builder $query): void
    {
        $query->where('type', 'kios');
    }

    protected $fillable = [
        'text',
        'show',
        'display_number',
        'type'
    ];
}
