<template>
  <div>
    <h2>{{ product.title }}</h2>
    <p>{{ product.body_html }}</p>
    <p>${{ product.variants[0].price }}</p>
    <button @click="cart.add(product)">Add to Cart</button>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { useCartStore } from '@/Stores/cart';
const cart = useCartStore();
const props = defineProps({ product: Object });
</script>
