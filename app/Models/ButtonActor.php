<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ButtonActor extends Model
{
    use HasFactory;

    protected $table = 'button_actor';

    public function codeService()
    {
        return $this->belongsTo(Codeservice::class, 'unit_service', 'initial');
    }

    protected $fillable = [
        'name',
        'counter_number',
        'unit_service',
        'last_queue_number',
        'last_queue_called',
        'user_button_code',
        'originationcust_SeqDt'
    ];
}
