<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codeservice extends Model
{
    use HasFactory;

    protected $table = 'codeservice';

    protected $primaryKey = 'Initial';

    public $incrementing = false;

    protected $keyType = 'string';

    public function buttons()
    {
        return $this->hasMany(ButtonActor::class, 'initial', 'unit_service');
    }

    public function haveQueue()
    {
        return $this->last_queue < $this->CurrentQNo;
    }

    public function sisaAntrian()
    {
        return $this->CurrentQNo - $this->last_queue;
    }

    protected $fillable = [
        'Name',
        'Initial',
        'CurrentQNo',
        'last_queue',
    ];
}
