<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCustomer extends Model
{
    use HasFactory;

    protected $table = 'transactioncust';

    public function scopenotSynced(Builder $query): void
    {
        $query->where('synced', '=', 'N');
    }

    protected $fillable = [
        'synced',
        'BaseDt',
        'SeqNumber',
        'TrxDesc',
        'TimeTicket',
        'TimeCall',
        'CustWaitDuration',
        'UnitServe',
        'CounterNo',
        'Absent',
        'UserId',
        'Flag',
        'TimeEnd',
        'Tservice',
        'TWservice',
        'TSLAservice',
        'TOverSLA'
    ];
}
