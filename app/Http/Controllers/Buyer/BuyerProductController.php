<?php

namespace App\Http\Controllers\Buyer;

use App\Buyer;
use function dd;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use function microtime;
use function var_dump;

class BuyerProductController extends ApiController
{
    /**
     * List of buyers with products
     * @param Buyer $buyer
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Buyer $buyer)
    {
        $products = $buyer->transactions()->with('product')->get()->pluck('product');

        return $this->showAll($products);
    }
}