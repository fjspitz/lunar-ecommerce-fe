<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(): View
    {
        $categories = $this->getCategories();
        $brands = $this->getBrands();
        $collections = [];

        return view('welcome', [
            'categories' => $categories,
            'brands' => $brands,
            'collections' => $collections,
        ]);
    }

    public function searchByName(Request $request): View
    {
        $query = [
            'customer_group' => 0,
            'value' => $request->input('name'),
            'criteria' => 'by_name',
        ];

        $collections = [];
        $categories = $this->getCategories();
        $brands = $this->getBrands();

        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/search/products', $query);

        $products = $response->json('data');

        return view('welcome', [
            'categories' => $categories,
            'brands' => $brands,
            'collections' => $collections,
            'products' => $products,
        ]);
    }

    public function searchByCategory(Request $request): View
    {
        $query = [
            'customer_group' => 0,
            'value' => $request->input('category_id'),
            'criteria' => 'by_category',
        ];

        $collections = [];
        $categories = $this->getCategories();
        $brands = $this->getBrands();

        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/search/products', $query);

        $products = $response->json('data');

        return view('welcome', [
            'categories' => $categories,
            'brands' => $brands,
            'collections' => $collections,
            'products' => $products,
        ]);
    }

    public function searchByBrand(Request $request): View
    {
        $query = [
            'customer_group' => 0,
            'value' => $request->input('brand_id'),
            'criteria' => 'by_brand',
        ];

        $collections = [];
        $categories = $this->getCategories();
        $brands = $this->getBrands();

        $base_url = config('app.lunar.url');
        $response = Http::withToken(config('app.lunar.token'))
            ->get($base_url . '/search/products', $query);

        $products = $response->json('data');

        return view('welcome', [
            'categories' => $categories,
            'brands' => $brands,
            'collections' => $collections,
            'products' => $products,
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
}
