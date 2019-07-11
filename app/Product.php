<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $fillable = [
        'name',
        'descrition',
        'quantity',
        'status', //available | unavailable
        'image',
        'seller_id'
    ];

    public function isAvailable():bool {
        return $this->status == self::AVAILABLE_PRODUCT;
    }
}
