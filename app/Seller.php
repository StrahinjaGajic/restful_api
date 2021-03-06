<?php

namespace App;

use App\Scopes\SellerScope;

class Seller extends User
{
    protected $table = 'users';

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::addGlobalScope(new SellerScope());
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
