<?php
/**
 * Created by PhpStorm.
 * User: Strahinja
 * Date: 8/15/2019
 * Time: 1:50 PM
 */

namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BuyerScope implements Scope
{
    public function apply(Builder $builder, Model $model) {
        $builder->has('transactions');
    }
}