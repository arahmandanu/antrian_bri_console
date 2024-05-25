<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCustomer extends Model
{
    use HasFactory;

    protected $table = 'transactioncust';

    public $timestamps = false;

    public function scopenotSynced(Builder $query): void
    {
        $query->where('synced', '=', 'N');
    }

    protected $fillable = [
        'synced',
    ];
}
