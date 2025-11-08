<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(): View
    {
        $stores = $this->getStores();
        $categories = $this->getCategories();
        $brands = $this->getBrands();
        $collections = [];
        $cartItems = $this->getCartItems();

        return view('welcome', [
            'categories' => $categories,
            'brands' => $brands,
            'collections' => $collections,
            'stores' => $stores,
            'cartItems' => $cartItems,
        ]);
    }

    public function searchByName(Request $request): View
    {
        $query = [
            'customer_group' => 0,
            'value' => $request->input('name'),
            'criteria' => 'by_name',
        ];

        $stores = $this->getStores();
        $collections = [];
        $categories = $this->getCategories();
        $brands = $this->getBrands();
        $cartItems = $this->getCartItems();

        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/search/products', $query);

        $products = $response->json('data');

        return view('welcome', [
            'categories' => $categories,
            'brands' => $brands,
            'collections' => $collections,
            'products' => $products,
            'stores' => $stores,
            'cartItems' => $cartItems,
        ]);
    }

    public function searchByCategory(Request $request): View
    {
        $query = [
            'customer_group' => 0,
            'value' => $request->input('category_id'),
            'criteria' => 'by_category',
        ];

        $stores = $this->getStores();
        $collections = [];
        $categories = $this->getCategories();
        $brands = $this->getBrands();
        $cartItems = $this->getCartItems();

        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/search/products', $query);

        $products = $response->json('data');

        return view('welcome', [
            'categories' => $categories,
            'brands' => $brands,
            'collections' => $collections,
            'products' => $products,
            'stores' => $stores,
            'cartItems' => $cartItems,
        ]);
    }

    public function searchByBrand(Request $request): View
    {
        $query = [
            'customer_group' => 0,
            'value' => $request->input('brand_id'),
            'criteria' => 'by_brand',
        ];

        $stores = $this->getStores();
        $collections = [];
        $categories = $this->getCategories();
        $brands = $this->getBrands();
        $cartItems = $this->getCartItems();

        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/search/products', $query);

        $products = $response->json('data');

        return view('welcome', [
            'categories' => $categories,
            'brands' => $brands,
            'collections' => $collections,
            'products' => $products,
            'stores' => $stores,
            'cartItems' => $cartItems,
        ]);
    }

    private function getCategories(): array
    {
        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/categories');

        return $response->json('data');
    }

    private function getBrands(): array
    {
        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/brands');

        return $response->json('data');
    }

    private function getStores(): array
    {
        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/merchants');

        return $response->json('data');
    }

    private function getCartItems(): array
    {
        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/carts/1');

        return $response->json('data.lines');
    }
}
