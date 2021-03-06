<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name','description'
    ];
    protected $hidden = [
        'pivot'
    ];

    public function product() {
        return $this->belongsToMany(Product::class,'category_product','category_id','product_id');
    }
}
