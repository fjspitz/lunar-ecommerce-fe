<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $items = $this->getCartItems();

        return view('cart', [
            'cartItems' => $items,
        ]);
    }

    public function add(Request $request)
    {
        //info("Product ID: {$request->input('product_id')}");

        $product_id = $request->input('product_id');

        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->post($base_url . '/carts/1/lines', [
                'purchasable_id' => $product_id,
                'quantity' => 1,
            ]);

        info($response->status());

        return redirect('/');
    }

    private function getCartItems(): array
    {
        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/carts/1');

        return $response->json('data');
    }
}
