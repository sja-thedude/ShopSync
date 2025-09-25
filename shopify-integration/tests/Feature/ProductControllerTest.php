<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShopifyService;

class ProductController extends Controller
{
    protected $shopify;

    public function __construct(ShopifyService $shopify)
    {
        $this->shopify = $shopify;
    }

    public function index()
    {
        $products = $this->shopify->getProducts();

        $normalized = array_map([$this, 'normalizeProduct'], $products);

        return view('products.index', ['products' => $normalized]);
    }

    public function show($id)
    {
        $product = $this->shopify->findProductById($id);

        if (!$product) {
            abort(404);
        }

        $normalized = $this->normalizeProduct($product);

        return view('products.show', ['product' => $normalized]);
    }

    private function normalizeProduct(array $product): array
    {
        return [
            'id' => $product['id'] ?? null,
            'title' => $product['title'] ?? 'Untitled',
            'description' => $product['body_html'] ?? '',
            'image' => $product['image']['src'] ?? null,
            'price' => $product['variants'][0]['price'] ?? 0,
            'variant_id' => $product['variants'][0]['id'] ?? null,
            'vendor' => $product['vendor'] ?? 'Unknown',
        ];
    }
}
