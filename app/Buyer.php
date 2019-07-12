<?php

namespace App;

class Buyer extends User
{
    protected $table = 'users';

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
