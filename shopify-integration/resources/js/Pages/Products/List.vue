<template>
  <AppLayout>
    <template #default>
      <div class="max-w-6xl mx-auto py-8">
        <h2 class="text-3xl font-bold mb-8 text-center">Products</h2>

        <div class="products-grid">
          <div v-for="p in products" :key="p.id" class="product-card">
            <!-- Image -->
            <img
            v-if="p.image"
            :src="typeof p.image === 'string' ? p.image : p.image.src"
            :alt="p.title"
            class="product-image"
            />

            <!-- Info -->
            <h3 class="product-title">{{ p.title }}</h3>
            <p class="product-description" v-html="p.body_html"></p>
            <div class="product-price">${{ parseFloat(p.price).toFixed(2) }}</div>

            <!-- Actions -->
            <div class="product-actions">
              <Link :href="`/products/${p.id}`" class="btn-view">View</Link>
              <button @click="cart.add(p)" class="btn-cart">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    </template>
  </AppLayout>
</template>

<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import { useCartStore } from '../../Stores/cart'
import { Link } from '@inertiajs/inertia-vue3'

const props = defineProps({ products: Array })
const cart = useCartStore()
</script>
