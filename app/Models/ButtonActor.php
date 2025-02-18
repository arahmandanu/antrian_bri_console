<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButtonActor extends Model
{
    use HasFactory;

    protected $table = 'button_actor';

    public const LISTNUMBERCOUNTER = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    public const LISTCOUNTERCODE = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

    public function codeService()
    {
        return $this->belongsTo(Codeservice::class, 'unit_service', 'initial');
    }

    public function lastOriginCustomer()
    {
        return $this->hasOne(OriginCustomer::class, 'SeqDt', 'originationcust_SeqDt');
    }

    public function getAllListNumber()
    {
        return $this->LISTNUMBERCOUNTER;
    }

    public function UsedListCounterNumber($unitService): array
    {
        $used = $this->where('unit_service', $unitService)->get()->pluck('counter_number')->toArray();
        return $used;
    }

    public function UsedListCounterCode(): array
    {
        $used = $this->all()->pluck('user_button_code')->toArray();
        return $used;
    }

    protected $fillable = [
        'name',
        'counter_number',
        'unit_service',
        'last_queue_number',
        'last_queue_called',
        'user_button_code',
        'originationcust_SeqDt',
    ];
}
