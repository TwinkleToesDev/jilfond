import './bootstrap';
import {createApp, h, provide} from "vue";

import App from "./App.vue";
import router from './router';
import store from './core/store/store';

import { ApolloClients } from '@vue/apollo-composable';
import { apolloClient } from './apollo/client';
import i18n from "./locales/index.js";

createApp({
    setup() {
        provide(ApolloClients, {
            default: apolloClient,
        });
    },
    render: () => h(App),
})
    .use(router)
    .use(store)
    .use(i18n)
    .mount('#app');
