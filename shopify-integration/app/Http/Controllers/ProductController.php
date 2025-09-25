<?php

namespace App\Http\Controllers;

use App\Services\ShopifyService;
use Inertia\Inertia;
use App\Models\Product;

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

        return Inertia::render('Products/List', [
            'products' => $products
        ]);
    }

    public function show($id)
    {
        $products = $this->shopify->getProducts();
        $product = collect($products)->firstWhere('id', (int)$id);

        return Inertia::render('Products/Show', [
            'product' => $product
        ]);
    }
}
