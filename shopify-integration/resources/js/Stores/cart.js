import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export const useCartStore = defineStore('cart', () => {
    const items = ref([]);

    function add(product) {
        const exist = items.value.find(i => i.id === product.id);
        if (exist) {
            exist.quantity++;
        } else {
            items.value.push({ ...product, quantity: 1 });
        }
    }

    function remove(index) {
        items.value.splice(index, 1);
    }

    function clear() {
        items.value = [];
    }

    const count = computed(() => items.value.reduce((acc, i) => acc + i.quantity, 0));
    const total = computed(() => items.value.reduce((acc, i) => acc + i.price * i.quantity, 0));

    return { items, add, remove, clear, count, total };
});
