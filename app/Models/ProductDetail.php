<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = 'product_detail';

    public function masterProduct()
    {
        return $this->hasOne(MasterProduct::class);
    }

    protected $fillable = [
        'master_product_id',
        'value',
        'suku_bunga',
        'display_number',
    ];
}
