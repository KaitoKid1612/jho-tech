import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../store";
import Home from "../pages/Home.vue";
import Login from "../pages/Login.vue";
import Signup from "../pages/Signup.vue";
import HomeLayout from "../layouts/HomeLayout.vue";

const routes = [
    {
        path: "/",
        component: HomeLayout,
        meta: { requiresAuth: true },
        children: [
            { path: "contacts", component: Home },
        ],
    },
    { path: "/login", component: Login },
    { path: "/signup", component: Signup },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
    if (to.meta.requiresAuth && !authStore.token) {
        next("/login");
    } else {
        next();
    }
});

export default router;
