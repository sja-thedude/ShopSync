<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\ShopifyService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_index_page_loads()
    {
        // Mock ShopifyService for index
        $this->mock(ShopifyService::class, function ($mock) {
            $mock->shouldReceive('getProducts')
                 ->once()
                 ->andReturn([
                     [
                         'id' => 1,
                         'title' => 'Test Product 1',
                         'body_html' => 'Description 1',
                         'variants' => [['price' => 9.99]],
                         'image' => ['src' => 'https://example.com/image1.jpg'],
                         'vendor' => 'Vendor 1',
                     ],
                     [
                         'id' => 2,
                         'title' => 'Test Product 2',
                         'body_html' => 'Description 2',
                         'variants' => [['price' => 19.99]],
                         'image' => ['src' => 'https://example.com/image2.jpg'],
                         'vendor' => 'Vendor 2',
                     ],
                 ]);
        });

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('Test Product 1');
        $response->assertSee('Test Product 2');
    }

    public function test_single_product_page_loads()
    {
        $testId = 12345;

        // Mock ShopifyService for show
        $this->mock(ShopifyService::class, function ($mock) use ($testId) {
            $mock->shouldReceive('findProductById')
                 ->with($testId)
                 ->once()
                 ->andReturn([
                     'id' => $testId,
                     'title' => 'Single Test Product',
                     'body_html' => 'Single product description',
                     'variants' => [['price' => 49.99]],
                     'image' => ['src' => 'https://example.com/single.jpg'],
                     'vendor' => 'Test Vendor',
                 ]);
        });

        $response = $this->get("/products/{$testId}");

        $response->assertStatus(200);
        $response->assertSee('Single Test Product');
        $response->assertSee('Single product description');
    }
}
