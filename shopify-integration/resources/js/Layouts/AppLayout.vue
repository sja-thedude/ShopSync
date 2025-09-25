<template>
  <div class="app-container">
    <header class="header">
      <div class="header-title">ShopSync</div>
      <div class="cart-wrapper" ref="cartRef">
        <button @click="show = !show" class="cart-button">
          🛒 Cart ({{ cart.count }})
        </button>

        <div v-if="show" class="cart-dropdown">
          <div v-if="cart.items.length === 0" class="cart-empty">Cart is empty</div>
          <div v-else>
            <div v-for="(item, i) in cart.items" :key="i" class="cart-item">
              <div class="cart-item-info">
                <div class="cart-item-title">{{ item.title }}</div>
                <div class="cart-item-qty">x {{ item.quantity }}</div>
              </div>
              <div class="cart-item-price">
                <div>${{ (item.price * item.quantity).toFixed(2) }}</div>
                <button @click="cart.remove(i)" class="cart-item-remove">Remove</button>
              </div>
            </div>

            <div class="cart-total">Total: ${{ cart.total.toFixed(2) }}</div>

            <div class="cart-actions">
                <button @click="cart.clear" class="cart-clear">Clear</button>
                <button @click="checkout" class="cart-checkout">Checkout</button>
            </div>
          </div>
        </div>
      </div>
    </header>

    <main class="main-content">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { useCartStore } from '../Stores/cart';

const cart = useCartStore();
const show = ref(false);
const cartRef = ref(null);

const checkout = () => {
  if (!cart.items.length) return alert('Cart is empty!');

  const items = cart.items.map(i => ({
  id: i.variant_id,
  quantity: i.quantity
}));

  fetch('/api/checkout-url', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  },
  body: JSON.stringify({ items })
})
.then(res => res.json())
.then(data => {
  if (data.url) window.open(data.url, '_blank');
  else alert('Failed to generate checkout link');
})
.catch(() => alert('Failed to generate checkout link'));
};

// Close dropdown when clicking outside
const handleClickOutside = (e) => {
  if (cartRef.value && !cartRef.value.contains(e.target)) show.value = false;
};

onMounted(() => document.addEventListener('click', handleClickOutside));
onBeforeUnmount(() => document.removeEventListener('click', handleClickOutside));
</script>
