<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShopifyService
{
    protected string $store;
    protected string $token;
    protected string $apiVersion;

    public function __construct()
    {
        $this->store = config('services.shopify.store_domain') ?? env('SHOPIFY_STORE_DOMAIN');
        $this->token = config('services.shopify.access_token') ?? env('SHOPIFY_ACCESS_TOKEN');
        $this->apiVersion = env('SHOPIFY_API_VERSION', '2025-01');
    }

    public function getProducts(): array
    {
        if (!$this->store || !$this->token) {
            return [];
        }

        $url = "https://{$this->store}/admin/api/{$this->apiVersion}/products.json?limit=50";

        $resp = Http::withHeaders([
            'X-Shopify-Access-Token' => $this->token,
            'Accept' => 'application/json',
        ])->get($url);

        if ($resp->successful()) {
            // return as array of products
            return $resp->json('products', []);
        }

        return [];
    }

    public function findProductById(int $id): ?array
    {
        $products = $this->getProducts();
        foreach ($products as $p) {
            if ((int)$p['id'] === $id) {
                return $p;
            }
        }
        return null;
    }
}
