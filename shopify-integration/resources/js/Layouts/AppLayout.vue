<template>
  <div>
    <header class="flex items-center justify-between p-4 bg-gray-100">
      <div class="text-lg font-bold">ShopSync</div>
      <div class="relative">
        <button @click="show = !show" class="px-3 py-1 rounded bg-blue-600 text-white">
          🛒 Cart ({{ cart.count }})
        </button>

        <div v-if="show" class="absolute right-0 mt-2 w-72 bg-white border shadow p-3 z-50">
          <div v-if="cart.items.length === 0" class="text-gray-500">Cart is empty</div>
          <div v-else>
            <div v-for="(item, i) in cart.items" :key="i" class="flex justify-between mb-2">
              <div>
                <div class="font-semibold">{{ item.title }}</div>
                <div class="text-sm text-gray-500">x {{ item.quantity }}</div>
              </div>
              <div class="text-right">
                <div>${{ (item.price * item.quantity).toFixed(2) }}</div>
                <button @click="cart.remove(i)" class="text-red-500 text-sm mt-1">Remove</button>
              </div>
            </div>

            <div class="border-t pt-2 font-bold">Total: ${{ cart.total.toFixed(2) }}</div>
            <button @click="cart.clear" class="mt-2 w-full bg-green-600 text-white py-1 rounded">Clear</button>
          </div>
        </div>
      </div>
    </header>

    <main class="p-4">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useCartStore } from '@/Stores/cart';

const cart = useCartStore();
const show = ref(false);
</script>

<style scoped>
/* minimal styles if you removed Tailwind */
</style>
