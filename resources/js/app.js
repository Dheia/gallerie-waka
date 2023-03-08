import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import dayjs from 'dayjs';
import fr from 'dayjs/locale/fr';
import relativeTime  from 'dayjs/plugin/relativeTime'
import localizedFormat  from 'dayjs/plugin/localizedFormat'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Gallerie';

const app = createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        dayjs.locale(fr);
        dayjs.extend(relativeTime)
        dayjs.extend(localizedFormat)
        const vueApp = createApp({ render: () => h(App, props) });
        
        vueApp.config.globalProperties.$date = dayjs;
        vueApp.provide('animate', "slide-fade")
        vueApp.use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#00ff00',
        delay: 500,
        includeCSS: true,
        showSpinner: true,
    },
});





