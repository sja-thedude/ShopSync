<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShopifyService
{
    protected $store;
    protected $token;

    public function __construct()
    {
        $this->store = env('SHOPIFY_STORE_DOMAIN');
        $this->token = env('SHOPIFY_ACCESS_TOKEN');
    }

    public function getProducts()
    {
        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $this->token,
            'Content-Type' => 'application/json',
        ])->get("https://{$this->store}/admin/api/2025-01/products.json");

        return $response->json()['products'] ?? [];
    }
}
