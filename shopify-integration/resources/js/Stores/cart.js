import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useCartStore = defineStore('cart', () => {
    const items = ref([]); // { id, title, price, quantity, image, variant_id }

    function add(product) {
        const exist = items.value.find(i => i.variant_id === product.variant_id);
        if (exist) {
            exist.quantity += 1;
        } else {
            items.value.push({
                id: product.id, // product ID
                title: product.title,
                price: parseFloat(product.price) || 0,
                image: product.image || null,
                variant_id: product.variant_id, // unique identifier for the variant
                quantity: 1,
            });
        }
    }

    function remove(index) {
        items.value.splice(index, 1);
    }

    function clear() {
        items.value = []; // Clear all items in the cart
    }

    const count = computed(() => items.value.reduce((s, p) => s + p.quantity, 0));
    const total = computed(() => items.value.reduce((s, p) => s + p.price * p.quantity, 0));

    return { items, add, remove, clear, count, total };
});
