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

    public function scopeshow(Builder $query): void
    {
        $query->where('displayed', true);
    }

    public function codeService()
    {
        return $this->belongsTo(Codeservice::class, 'UnitService', 'Initial');
    }

    protected $fillable = [
        'displayed',
        'TrxCode',
        'Tservice',
        'TrxName',
        'UnitService',
    ];
}
