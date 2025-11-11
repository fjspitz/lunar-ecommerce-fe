<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Cart extends Component
{
    public array $items;

    public int $cart_total_products;

    public float $cart_total_amount;

    public function mount()
    {
        $this->items = $this->getCartItems();
        $this->cart_total_products = sizeof($this->items);
        $this->cart_total_amount = $this->cartTotalAmount($this->items);
    }

    public function increase($purchasable_id)
    {
        info("Increase: {$purchasable_id}");

        $data = collect($this->items);
        $key = $data->search(fn($item) => $item['purchasable_id'] === $purchasable_id);
        if ($key !== false) {
            $item = $data->get($key);
            $original_quantity = $item['quantity'];
            $data->put($key, array_merge($item, ['quantity' => $original_quantity + 1]));
            $this->items = $data->all();
        }
        $this->cart_total_products = collect($this->items)->sum('quantity');
        $this->cart_total_amount = $this->cartTotalAmount($this->items);
    }

    public function decrease($purchasable_id)
    {
        info("Decrease: {$purchasable_id}");

        $data = collect($this->items);
        $key = $data->search(fn($item) => $item['purchasable_id'] === $purchasable_id);
        if ($key !== false) {
            $item = $data->get($key);
            $original_quantity = $item['quantity'];
            $data->put($key, array_merge($item, ['quantity' => $original_quantity - 1]));
            $this->items = $data->all();
        }
        $this->cart_total_products = collect($this->items)->sum('quantity');
        $this->cart_total_amount = $this->cartTotalAmount($this->items);
    }

    public function render()
    {
        // $items = $this->getCartItems();
        // $cart_size = sizeof($items);

        return view('livewire.cart');
    }

    private function cartTotalAmount(array $items): float
    {
        // collect($items)->each(function ($item) {

        // });

        $total = 0;

        foreach ($items as $item) {
            $quantity = $item['quantity'];
            $price = $item['product']['price'];
            $amount = $quantity * $price;
            $total += $amount;
        }

        return $total;
    }

    private function getCartItems(): array
    {
        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/carts/1');

        return $response->json('data.lines');
    }
}
