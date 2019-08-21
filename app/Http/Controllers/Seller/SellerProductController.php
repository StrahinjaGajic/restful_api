<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class SellerProductController extends ApiController
{

    /**
     * @param Seller $seller
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Seller $seller) {
        $products = $seller->products
            ->unique('id')
            ->values()
        ;

        return $this->showAll($products);
    }

    public function store(Request $request, Seller $seller) {
        $product = $seller->products;

        return $this->showOne($product);
    }
}
