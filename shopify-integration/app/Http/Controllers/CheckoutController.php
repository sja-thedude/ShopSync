<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function generateUrl(Request $request)
    {
        $items = $request->input('items', []); // Expecting array of ['id' => product_id, 'quantity' => qty]

        // Build cart query string for Shopify
        $cartQuery = implode(',', array_map(fn($i) => "{$i['id']}:{$i['quantity']}", $items));
        $store = env('SHOPIFY_STORE_DOMAIN');

        $checkoutUrl = empty($cartQuery) ? "https://{$store}/cart" : "https://{$store}/cart/{$cartQuery}";

        return response()->json(['url' => $checkoutUrl]);
    }
}
