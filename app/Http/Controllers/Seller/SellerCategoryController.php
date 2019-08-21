<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class SellerCategoryController extends ApiController
{

    /**
     * @param Seller $seller
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Seller $seller) {
        $categories = $seller->products()->with('categories')->has('categories')->get()
            ->pluck('categories')
            ->collapse()
            ->unique('id')
            ->values()
        ;

        return $this->showAll($categories);
    }
}
