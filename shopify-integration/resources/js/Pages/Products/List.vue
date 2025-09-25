<template>
  <AppLayout>
    <template #default>
      <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold mb-6">Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="p in products" :key="p.id" class="border p-4 rounded shadow">
            <img v-if="p.image" :src="p.image" class="w-full h-40 object-cover mb-3" />
            <h3 class="font-semibold">{{ p.title }}</h3>
            <p class="text-sm text-gray-600" v-html="p.body_html"></p>
            <div class="mt-2 font-bold">${{ parseFloat(p.price).toFixed(2) }}</div>

            <div class="mt-4 flex justify-between items-center">
              <Link :href="`/products/${p.id}`" class="text-blue-600">View</Link>
              <button @click="cart.add(p)" class="bg-blue-600 text-white px-3 py-1 rounded">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    </template>
  </AppLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { useCartStore } from '@/Stores/cart';

const props = defineProps({
  products: Array
});

const cart = useCartStore();
</script>

<style scoped>
/* add minimal CSS if you removed Tailwind */
</style>
