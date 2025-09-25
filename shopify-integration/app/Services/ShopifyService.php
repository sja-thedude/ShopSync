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
        $this->store = config('services.shopify.store_domain') ?? env('SHOPIFY_STORE_DOMAIN'); // e.g., 'your-store.myshopify.com'
        $this->token = config('services.shopify.access_token') ?? env('SHOPIFY_ACCESS_TOKEN');
        $this->apiVersion = env('SHOPIFY_API_VERSION', '2025-01');
    }

    public function getProducts(): array
    {
        if (!$this->store || !$this->token) { // Basic validation
            return [];
        }

        $url = "https://{$this->store}/admin/api/{$this->apiVersion}/products.json?limit=50"; // limit to 50 for demo purposes

        $resp = Http::withHeaders([
            'X-Shopify-Access-Token' => $this->token,
            'Accept' => 'application/json', // Ensure we accept JSON responses
        ])->get($url);

        return $resp->successful() ? $resp->json('products', []) : []; // Return empty array on failure
    }

    public function findProductById(int $id): ?array
    {
        foreach ($this->getProducts() as $p) {
            if ((int)$p['id'] === $id) {
                return $p;
            }
        }
        return null; // Not found
    }
}
