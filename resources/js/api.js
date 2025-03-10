import axios from 'axios';
import { useAuthStore } from './store';

const api = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json'
    },
    withCredentials: true
});

api.interceptors.request.use(config => {
    const authStore = useAuthStore();
    if (authStore.token) {
        config.headers.Authorization = `Bearer ${authStore.token}`;
    }
    return config;
}, error => Promise.reject(error));

export default api;
