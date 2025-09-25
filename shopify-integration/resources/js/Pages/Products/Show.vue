<template>
  <AppLayout>
    <template #default>
      <div class="show-container">
        <div class="back-link">
          <Link href="/products">← Back to Products</Link>
        </div>

        <div class="product-card">
          <h2 class="product-title">{{ product.title }}</h2>

          <img
            v-if="product.image"
            :src="typeof product.image === 'string' ? product.image : product.image.src"
            :alt="product.title"
            class="product-image"
          />

          <p class="product-description" v-html="product.body_html"></p>
          <div class="product-price">${{ parseFloat(product.price).toFixed(2) }}</div>

          <div class="product-actions">
            <button @click="cart.add(product)" class="btn-cart">Add to Cart</button>
          </div>
        </div>
      </div>
    </template>
  </AppLayout>
</template>

<script setup>
import AppLayout from '../../Layouts/AppLayout.vue'
import { useCartStore } from '../../Stores/cart'
import { Link } from '@inertiajs/inertia-vue3';

const cart = useCartStore();
const props = defineProps({
  product: Object
});
</script>

<style scoped>
.show-container {
  max-width: 700px;
  margin: 0 auto;
  padding: 20px;
}

.back-link {
  margin-bottom: 16px;
  font-size: 0.95rem;
}

.product-card {
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  background: #fff;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  text-align: center;
}

.product-title {
  font-size: 1.8rem;
  font-weight: bold;
  margin-bottom: 12px;
}

.product-image {
  width: 250px;         /* normal size */
  height: 250px;
  object-fit: contain;   /* maintains aspect ratio */
  margin: 0 auto 16px;  /* center + spacing */
  border-radius: 6px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.product-description {
  font-size: 0.95rem;
  color: #555;
  margin-bottom: 12px;
}

.product-price {
  font-weight: bold;
  font-size: 1.2rem;
  margin-bottom: 16px;
}

.product-actions {
  display: flex;
  justify-content: center;
}

.btn-cart {
  background-color: #1d4ed8;
  color: #fff;
  padding: 8px 16px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
  font-weight: bold;
}

.btn-cart:hover {
  background-color: #2563eb;
}
</style>
