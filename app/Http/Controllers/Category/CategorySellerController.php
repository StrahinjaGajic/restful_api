<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategorySellerController extends ApiController
{
    public function index(Category $category) {
        $products = $category->product()->with('seller')->get()
            ->pluck('seller')
            ->unique()
            ->values();

        return $this->showAll($products);
    }
}