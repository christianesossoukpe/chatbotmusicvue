import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

// Indique à Vite de récupérer toutes les pages
const pages = import.meta.glob('./Pages/**/*.vue');

// Crée l'application Inertia
createInertiaApp({
  resolve: name => {
    // pages[name] doit être une fonction retournant une promesse
    const page = pages[`./Pages/${name}.vue`];
    if (!page) throw new Error(`Page ${name} not found`);
    return page();
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el);
  },
});

// Barre de progression Inertia
InertiaProgress.init();
