<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionParam extends Model
{
    use HasFactory;

    protected $table = 'trxparam';

    protected $primaryKey = 'TrxCode';

    public $timestamps = false;

    public const ENABLED_TRX = ['01', '02'];

    public function scopeshow(Builder $query): void
    {
        $query->where('displayed', true);
    }

    public function scopeenabled(Builder $query): void
    {
        $query->WhereIn('UnitService', self::ENABLED_TRX);
    }

    protected $fillable = [
        'displayed',
        'TrxCode',
        'Tservice',
        'TrxName',
        'UnitService',
    ];
}
