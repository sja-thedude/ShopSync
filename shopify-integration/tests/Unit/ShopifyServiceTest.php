<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ShopifyService;

class ShopifyServiceTest extends TestCase
{
    public function test_get_products_returns_array()
    {
        $service = new ShopifyService();
        $products = $service->getProducts();

        $this->assertIsArray($products);
    }

    public function test_find_product_by_id_returns_product_or_null()
    {
        $service = new ShopifyService();
        $products = $service->getProducts();

        if (count($products) > 0) {
            $id = $products[0]['id'];
            $product = $service->findProductById($id);
            $this->assertIsArray($product);
            $this->assertEquals($id, $product['id']);
        } else {
            $this->assertNull($service->findProductById(12345));
        }
    }
}
