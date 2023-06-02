import './bootstrap';
import '../css/app.css';
import 'flowbite';

import { createApp, h } from 'vue';
import { createStore } from 'vuex'
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const store = createStore({
    state() {
        return {
            count: 0,
            cart: {}
        }
    },
    mutations: {
        addToCart(state, payload) {
            state.cart[payload.id] = payload
        },
        removeFromCart(state, id) {
            delete state.cart[id]
        },
        increment(state) {
            state.count++
        }
    }
})

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(store)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
