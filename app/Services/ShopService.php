<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;

class ShopService
{
    public function getCatalog()
    {
        return ProductResource::collection(Product::all());
    }

    public function createOrder(array $data)
    {
        $user = User::findOrFail($data['user_id']);

        $order = Order::create([
            'order_number'=>Str::uuid(),
            'user_id'=>$user->id,
        ]);

        foreach ($data['products'] as $productData) {
            $product = Product::findOrFail($productData['id']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $productData['quantity'],
                'price_at_order' => $product->price,
            ]);

            $product->decrement('stock', $productData['quantity']);
        }

        return ['message' => 'Order created successfully', 'order' => $order];
    }

    public function approveOrder(array $data)
    {
        $order = Order::with('items')->findOrFail($data['order_id']);
        $user = $order->user;
        $totalCost = $order->items->sum(fn($item) => $item->price_at_order * $item->quantity);

        if($user->balance < $totalCost) {
            return response()->json(['error' => 'Not enough balance'], 400);
        }

        $user->decrement('balance', $totalCost);
        $order->update(['status' => 'approved']);

        return $order;
    }
}
