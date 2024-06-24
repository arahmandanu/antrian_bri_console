<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OriginCustomer extends Model
{
    use HasFactory;

    protected $table = 'originationcust';

    protected $primaryKey = 'SeqDt';

    public function scopeCall(Builder $query): void
    {
        $query->where('Flag', 'P')->orderBy('origin_queue_number', 'asc');
    }

    public function transactionParam()
    {
        return $this->belongsTo(TransactionParam::class, 'code_trx', 'TrxCode');
    }

    protected $fillable = [
        'SeqNumber',
        'BaseDt',
        'UnitServe',
        'TimeTicket',
        'TimeCall',
        'WaitDuration',
        'Flag',
        'SeqDt',
        'DescTransaksi',
        'UnitCall',
        'code_trx',
        'SLA_Trx',
        'is_queue_online',
        'origin_queue_number',
    ];
}
