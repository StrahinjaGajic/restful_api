<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'descrition',
        'quantity',
        'status', //available | unavailable
        'image',
        'seller_id'
    ];
    protected $hidden = [
        'pivot'
    ];

    public function isAvailable():bool {
        return $this->status == self::AVAILABLE_PRODUCT;
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
    public function seller() {
        return $this->belongsTo(Seller::class);
    }
}
