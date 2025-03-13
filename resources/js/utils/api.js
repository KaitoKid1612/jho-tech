import axios from "axios";
import { useAuthStore } from "@/store";
import router from "@/router";

const api = axios.create({
    baseURL: "http://localhost:8765/api",
    headers: { "Content-Type": "application/json" },
    withCredentials: true
});

api.interceptors.request.use(config => {
    const authStore = useAuthStore();
    if (authStore.token) {
        config.headers.Authorization = `Bearer ${authStore.token}`;
    }
    return config;
}, error => Promise.reject(error));

api.interceptors.response.use(
    response => response,
    error => {
        if (error.response?.status === 401) {
            const authStore = useAuthStore();
            authStore.logout();
            router.push("/login");
        }
        return Promise.reject(error);
    }
);

export default api;
