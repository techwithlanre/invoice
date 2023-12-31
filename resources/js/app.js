import './bootstrap';
import '../css/app.css';

import {createApp, h, VueElement} from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import ToastPlugin, {useToast} from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-bootstrap.css';


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const toast = useToast();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const myApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(ToastPlugin);
        myApp.config.globalProperties.toast = toast;
        myApp.mount(el)
        return myApp;
    },

    progress: {
        color: '#4B5563',
    },
});
