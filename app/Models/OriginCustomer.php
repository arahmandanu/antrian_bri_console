<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OriginCustomer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'originationcust';

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
        'is_queue_online'
    ];
}
