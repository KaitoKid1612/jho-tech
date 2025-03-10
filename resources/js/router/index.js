import { createRouter, createWebHistory } from 'vue-router';
import { useAuthStore } from '../store';
import Home from '../pages/Home.vue';
import Contacts from '../pages/Contacts.vue';
import Login from '../pages/Login.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/contacts', component: Contacts, meta: { requiresAuth: true } },
    { path: '/login', component: Login }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
    if (to.meta.requiresAuth && !authStore.token) {
        next('/login');
    } else {
        next();
    }
});

export default router;
