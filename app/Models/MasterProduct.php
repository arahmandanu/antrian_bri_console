<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProduct extends Model
{
    use HasFactory;

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class)->orderBy('display_number', 'asc');
    }

    public function scopeShow(Builder $query): void
    {
        $query->where('show', true)->orderBy('display_number', 'asc');
    }

    protected $fillable = [
        'name',
        'display_number',
        'show',
    ];

    protected $casts = [
        'show' => 'boolean',
    ];
}
