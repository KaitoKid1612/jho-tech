<template>
  <header class="flex h-[72px] justify-between items-center gap-4 bg-[#17202E] px-5 w-full">
    <!-- Logo -->
    <div class="flex items-center gap-2">
      <img
        src="/images/logo.png"
        alt="MetaForum Logo"
        class="h-6 text-white"
      />
    </div>

    <!-- Search Bar -->
    <div class="flex gap-3">
      <div class="flex flex-1 items-center gap-2">
        <div class="relative flex-1 w-full max-h-[40px]">
          <img
            src="/images/icon/search.png"
            alt="Search"
            class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-500"
          />
          <input
            v-model="searchQuery"
            class="w-full pl-8 pr-3 py-2 bg-[#232B39] text-[12px] placeholder-white border-none rounded-[24px] text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]"
            placeholder="Rechercher dans MetaForum"
            type="search"
          />
        </div>
      </div>
      <!-- Add Button -->
      <button class="w-[40px] h-[40px] bg-[#DD5313] hover:bg-[#f85149]/90 text-white text-xl flex justify-center items-center font-bold rounded-full">
        +
      </button>
    </div>

    <!-- Icons -->
    <div class="flex">
      <nav class="flex items-center gap-4">
        <button class="p-2 text-gray-400 hover:text-white">
          <img
            src="/images/icon/notification.png"
            alt="Notifications"
            class="w-4 h-4"
          />
        </button>
        <button class="p-2 text-gray-400 hover:text-white">
          <img
            src="/images/icon/messages.png"
            alt="Messages"
            class="w-4 h-4"
          />
        </button>
        <button class="p-2 text-gray-400 hover:text-white">
          <img
            src="/images/icon/setting.png"
            alt="Settings"
            class="w-4 h-4"
          />
        </button>
      </nav>

      <!-- User Profile -->
      <div class="flex items-center gap-2">
        <div class="h-8 w-8 rounded-full bg-gray-600 flex items-center justify-center text-white text-sm font-medium">
          {{ userInitials }}
        </div>
        <div class="text-xs text-white">
          <div>{{ userName }}</div>
          <div class="text-xs text-gray-400">{{ userRole }}</div>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, computed } from "vue";

// Reactive variables
const searchQuery = ref("");

// User data (could be from Vuex, Pinia, or API)
const userName = ref("Sébastien Hannoux");
const userRole = ref("CEO, Admin");

// Compute initials from name
const userInitials = computed(() => {
  return userName.value
    .split(" ")
    .map((n) => n[0])
    .join("")
    .toUpperCase();
});
</script>
