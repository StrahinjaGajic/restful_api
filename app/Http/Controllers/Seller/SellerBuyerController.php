<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use App\Http\Controllers\ApiController;

class SellerBuyerController extends ApiController
{

    /**
     * @param Seller $seller
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Seller $seller) {
        $buyers = $seller->products()->with('transactions.buyer')->has('transactions.buyer')->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('buyer')
            ->unique('id')
            ->values()
        ;

        return $this->showAll($buyers);
    }
}
