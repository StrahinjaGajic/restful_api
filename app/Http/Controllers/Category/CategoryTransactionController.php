<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoryTransactionController extends ApiController
{

    public function index(Category $category) {
        $products = $category->product()->with('transactions')->has('transactions')->get()
            ->pluck('transactions')
            ->collapse();

        return $this->showAll($products);
    }
}
