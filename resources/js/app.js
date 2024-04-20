import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { ZiggyVue } from "ziggy";
import PrimeVue from "primevue/config";
import "../css/app.css";
import "primeicons/primeicons.css";

import "primevue/resources/themes/md-light-indigo/theme.css";
import MainLayout from "./Layouts/MainLayout.vue";

createInertiaApp({

    // Progress indicator
    progress: {
        delay: 250, // Only show bar if request takes more than 250ms
        color: '#3F51B5',
        includeCSS: true,
        showSpinner: true
    },


    // Resolve vue files, layouts
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });

        // Add default layout to all components
        const page = pages[`./Pages/${name}.vue`];

        // Exceptions
        if (name !== "Account/Create" && name !== "Authentication/Login") {
            page.default.layout = page.default.layout || MainLayout;
        }

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue)
            .use(ZiggyVue)

            .mount(el);
    },
});
