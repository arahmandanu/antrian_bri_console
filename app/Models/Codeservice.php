<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Codeservice extends Model
{
    use HasFactory;

    protected $table = 'codeservice';

    protected $primaryKey = 'Initial';

    public $timestamps = false;

    protected $fillable = [
        'Name',
        'Initial',
        'CurrentQNo',
        'last_queue',
    ];
}
