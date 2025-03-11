<template>
  <div class="flex items-center gap-4">
    <!-- Select 1 -->
    <div class="relative flex-1 max-w-[407px] max-h-[40px]">
      <img src="/images/icon/preferences.png" alt="Filter" class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-500" />
      <select v-model="filter1" class="w-full pl-8 pr-3 py-2 bg-transparent text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]">
        <option value="1">Plus de filtre</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
    </div>

    <!-- Select 2 -->
    <div class="relative flex-1 max-w-[407px] max-h-[40px]">
      <img src="/images/icon/users.png" alt="Users" class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-500" />
      <select v-model="filter2" class="w-full pl-8 pr-3 py-2 bg-transparent text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]">
        <option value="1">Plus de filtre</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
    </div>

    <!-- Search Input -->
    <div class="relative flex-1 max-w-[407px] max-h-[40px]">
      <img src="/images/icon/search.png" alt="Search" class="absolute left-2.5 top-2.5 w-4 h-4 text-white" />
      <input v-model="searchQuery" placeholder="Text, contact, response..." type="search" class="w-full pl-8 pr-3 py-2 bg-transparent text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]" />
    </div>

    <!-- Settings Button -->
    <button class="border border-gray-700 rounded-lg w-8 h-8 flex items-center justify-center">
      <img src="/images/icon/setting.png" alt="Settings" class="w-4 h-4 text-white" />
    </button>
  </div>
</template>

<script setup>
import { ref } from "vue";

const filter1 = ref("1");
const filter2 = ref("1");
const searchQuery = ref("");
</script>
