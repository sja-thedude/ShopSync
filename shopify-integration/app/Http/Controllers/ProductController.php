<?php

namespace App\Http\Controllers;

use App\Services\ShopifyService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    protected ShopifyService $shopify;

    public function __construct(ShopifyService $shopify)
    {
        $this->shopify = $shopify;
    }

    public function index()
    {
        $products = $this->shopify->getProducts();

        // Normalize minimal fields for frontend
        $list = array_map([$this, 'normalizeProduct'], $products);

        return Inertia::render('Products/List', [
            'products' => $list,
        ]);
    }

    public function show($id)
    {
        $product = $this->shopify->findProductById((int)$id);

        if (!$product) {
            abort(404);
        }

        // Normalize product for frontend
        $p = $this->normalizeProduct($product);

        return Inertia::render('Products/Show', [
            'product' => $p,
        ]);
    }

    /**
     * Normalize Shopify product data for frontend.
     *
     * @param array $p
     * @return array
     */
    private function normalizeProduct(array $p): array
    {
        return [
            'id' => (int)$p['id'],
            'variant_id' => $p['variants'][0]['id'],
            'title' => $p['title'] ?? '',
            'body_html' => $p['body_html'] ?? '',
            'price' => $p['variants'][0]['price'] ?? 0,
            'image' => $p['image']['src'] ?? null,
            'vendor' => $p['vendor'] ?? null,
            'raw' => $p, // optional: full product for debugging or future use
        ];
    }
}
