import '../css/app.css';
import './bootstrap';
import { createApp, h } from 'vue';
import { createPinia } from 'pinia';
import { ZiggyVue } from 'ziggy-js/dist/vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';

// Dynamically require all Vue pages
const pages = {};
const requirePage = require.context('./Pages', true, /\.vue$/);
requirePage.keys().forEach(key => {
    const name = key.replace(/^.\//, '').replace(/\.vue$/, '');
    pages[name] = requirePage(key).default;
});

const pinia = createPinia();

createInertiaApp({
    resolve: name => pages[name],
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue)
            .mount(el);
    }
});
