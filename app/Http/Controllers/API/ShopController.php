<?php

namespace App\Http\Controllers\API;

use App\Facades\ShopFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveOrderRequest;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Http\JsonResponse;

class ShopController extends Controller
{
    public function catalog(): JsonResponse
    {
        return response()->json(ShopFacade::getCatalog());
    }

    public function createOrder(CreateOrderRequest $request)
    {
        return response()->json(ShopFacade::createOrder($request->validated()));
    }

    public function approveOrder(ApproveOrderRequest $request)
    {
        return response()->json(ShopFacade::approveOrder($request->validated()));
    }
}
