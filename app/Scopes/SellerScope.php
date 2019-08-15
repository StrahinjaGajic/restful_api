<?php
/**
 * Created by PhpStorm.
 * User: Strahinja
 * Date: 8/15/2019
 * Time: 2:03 PM
 */

namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SellerScope implements Scope
{
    public function apply(Builder $builder, Model $model) {
        $builder->has('products');
    }
}