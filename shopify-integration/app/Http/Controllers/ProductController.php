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
        $list = array_map(function($p) {
            return [
                'id' => (int)$p['id'],
                'title' => $p['title'] ?? '',
                'body_html' => $p['body_html'] ?? '',
                'price' => $p['variants'][0]['price'] ?? 0,
                'image' => $p['image']['src'] ?? null,
                'vendor' => $p['vendor'] ?? null,
                'raw' => $p, // optional: full product for later
            ];
        }, $products);

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

        $p = [
            'id' => (int)$product['id'],
            'title' => $product['title'] ?? '',
            'body_html' => $product['body_html'] ?? '',
            'price' => $product['variants'][0]['price'] ?? 0,
            'image' => $product['image']['src'] ?? null,
            'vendor' => $product['vendor'] ?? null,
            'raw' => $product,
        ];

        return Inertia::render('Products/Show', [
            'product' => $p,
        ]);
    }
}
