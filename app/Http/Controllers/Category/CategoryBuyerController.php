<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryBuyerController extends ApiController
{
    public function index(Category $category) {
        $products = $category->product()->with('transactions.buyer')->has('transactions.buyer')->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values()
        ;

        return $this->showAll($products);
    }
}
