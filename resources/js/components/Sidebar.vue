<template>
    <aside class="flex min-h-screen w-[60px] flex-col bg-[#17202E] py-4">
        <!-- Logo -->
        <div class="mb-9 flex justify-center">
            <img src="/images/logo-small.png" alt="Logo" class="h-6 w-6" />
        </div>

        <!-- Navigation -->
        <!-- Navigation -->
        <nav class="flex flex-1 flex-col items-center">
            <button v-for="(item, index) in navItems" :key="index"
                class="flex justify-center w-full p-[15px] transition-colors" :class="{
                    'bg-[#DD531333] border-r-2 border-[#DD5313]': item.label === 'Contacts'
                }">
                <img :src="item.icon" :alt="item.label"
                    class="h-5 w-5 text-gray-400 transition-colors group-hover:text-white" />
            </button>
        </nav>

        <!-- Bottom Section -->
        <div class="mt-auto flex justify-center">
            <button class="group relative p-2" @click="handleLogout">
                <img src="/images/icon/Group 18.svg" alt="Logout"
                    class="h-5 w-5 text-gray-400 transition-colors group-hover:text-white" />
            </button>
        </div>
    </aside>
</template>

<script setup>
import { useRouter } from "vue-router";
import { useAuthStore } from "../store/index";

const router = useRouter();
const authStore = useAuthStore();

const handleLogout = () => {
    authStore.logout();
    router.push("/login");
};

const navItems = [
    { label: "Home", icon: "/images/icon/Group 6.svg" },
    { label: "Explore", icon: "/images/icon/2 User 1.svg" },
    { label: "Messages", icon: "/images/icon/Group 8.svg" },
    { label: "Notifications", icon: "/images/icon/Group 7.svg" },
    { label: "Bookmarks", icon: "/images/icon/Group 13.svg" },
    { label: "Lists", icon: "/images/icon/Group 12.svg" },
    { label: "Profile", icon: "/images/icon/Group 9.svg" },
    { label: "More", icon: "/images/icon/Group 10.svg" },
    { label: "More", icon: "/images/icon/Group 15.svg" },
    { label: "Contacts", icon: "/images/icon/Group 16.svg" },
    { label: "More", icon: "/images/icon/Group 17.svg" },
];
</script>
