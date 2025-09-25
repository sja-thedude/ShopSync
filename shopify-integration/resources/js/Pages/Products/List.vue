<template>
  <div>
    <h2 class="text-center text-3xl font-bold mb-6">Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="product in products" :key="product.id" class="border rounded shadow p-4">
        <h3>{{ product.title }}</h3>
        <p>{{ product.body_html }}</p>
        <p>${{ product.variants[0].price }}</p>
        <button @click="cart.add(product)">Add to Cart</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { useCartStore } from '@/Stores/cart';

const cart = useCartStore();
const props = defineProps({ products: Array });
</script>
