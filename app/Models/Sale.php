<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'productid',
        'quantity',
        'unitcost',
        'sellingprice'
    ];

    public function CoffeeProduct()
    {
        return $this->belongsTo(CoffeeProduct::class, 'productid');
    }
}
