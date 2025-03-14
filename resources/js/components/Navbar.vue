<template>
    <header class="flex h-[72px] justify-between items-center gap-4 bg-[#17202E] px-6 w-full">
        <!-- Logo -->
        <div></div>

        <!-- Search Bar -->
        <div class="flex gap-3">
            <div class="flex flex-1 items-center gap-2 w-[407px]">
                <div class="relative flex-1 w-full h-[40px]">
                    <img src="/images/icon/search.png" alt="Search"
                        class="absolute left-4 top-2.5 w-4.5 h-4.5 text-gray-500" />
                    <input v-model="searchQuery"
                        class="w-full h-full pl-10 pr-3 py-3 bg-[#232B39] text-[12px] placeholder-white border-none rounded-[24px] text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]"
                        placeholder="Rechercher dans Metaforma" type="search" />
                </div>
            </div>
            <!-- Add Button -->
            <button class="w-10 h-10 bg-[#DD5313] rounded-full flex items-center justify-center">
                <div class="relative w-3 h-3">
                    <div class="absolute w-[12px] h-[2px] bg-white top-1/2 left-0 transform -translate-y-1/2"></div>
                    <div class="absolute h-[12px] w-[2px] bg-white top-0 left-1/2 transform -translate-x-1/2"></div>
                </div>
            </button>
        </div>

        <!-- Icons -->
        <div class="flex">
            <nav class="flex items-center gap-3">
                <img src="/images/icon/Notification 1.svg" alt="Notifications" class="w-4 h-4" />
                <img src="/images/icon/messages question 1.svg" alt="Messages" class="w-4 h-4" />
                <img src="/images/icon/Setting 3.svg" alt="Settings" class="w-4 h-4 mr-2" />
            </nav>

            <!-- User Profile -->
            <div class="flex items-center gap-2">
                <div
                    class="h-8 w-8 rounded-full bg-gray-600 flex items-center justify-center text-white text-sm font-medium">
                    {{ userInitials }}
                </div>
                <div class="text-xs text-white">
                    <div class="font-bold">{{ user?.name || "Guest" }}</div>
                    <div class="text-xs text-gray-400">{{ user?.role || "Unknown" }}</div>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref, computed } from "vue";
import { useAuthStore } from "../store/index";

const searchQuery = ref("");

const authStore = useAuthStore();
const user = computed(() => authStore.user);

const userInitials = computed(() => {
    if (!user.value || !user.value.name) return "";
    return user.value.name
        .split(" ")
        .map((n) => n[0])
        .join("")
        .toUpperCase();
});
</script>
