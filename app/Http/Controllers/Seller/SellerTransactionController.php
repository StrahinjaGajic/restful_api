<?php

namespace App\Http\Controllers\Seller;

use App\Seller;
use App\Http\Controllers\ApiController;

class SellerTransactionController extends ApiController
{

    /**
     * @param Seller $seller
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Seller $seller) {
        $transactions = $seller->products()->with('transactions')->has('transactions')->get()
            ->pluck('transactions')
            ->collapse()
            ;

        return $this->showAll($transactions);
    }
}
