<template>
  <AppLayout>
    <template #default>
      <div class="max-w-3xl mx-auto">
        <div class="mb-4">
          <Link href="/products" class="text-blue-600">← Back to Products</Link>
        </div>

        <div class="p-4 border rounded shadow bg-white">
          <h2 class="text-2xl font-bold mb-2">{{ product.title }}</h2>
          <img v-if="product.image" :src="product.image" class="w-full h-64 object-cover mb-4" />
          <p v-html="product.body_html" class="mb-2"></p>
          <div class="font-semibold mb-4">${{ parseFloat(product.price).toFixed(2) }}</div>

          <div class="text-center">
            <button @click="cart.add(product)" class="bg-blue-600 text-white px-4 py-2 rounded">Add to Cart</button>
          </div>
        </div>
      </div>
    </template>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { useCartStore } from '@/Stores/cart';
import { defineProps } from 'vue';

const cart = useCartStore();
const props = defineProps({
  product: Object
});
</script>
