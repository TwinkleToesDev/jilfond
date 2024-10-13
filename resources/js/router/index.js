import { createRouter, createWebHistory } from 'vue-router';
import MainPage from '../core/components/MainPage.vue';
import UserProfile from "../modules/search/views/UserProfile.vue";
import Layout from "../core/views/Layout.vue";

// const routes = [
//     {
//         path: '/',
//         name: 'Home',
//         components: {
//             default: MainPage,
//             sidebar: Sidebar,
//         }
//     },
//     {
//         path: '/user/:id',
//         name: 'UserProfile',
//         components: {
//             default: MainPage,
//             sidebar: Sidebar,
//         }
//     },
// ];

const routes = [
    {
        path: '/',
        component: Layout,
        children: [
            {
                path: '',
                name: 'Home',
                component: MainPage,
            },
            {
                path: 'user/:id',
                name: 'UserProfile',
                component: UserProfile,
            },
            // Другие маршруты
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
