<template>
  <div class="flex min-h-screen">
    <Sidebar class="w-5 flex-shrink-0"/>
    <div class="flex flex-col flex-1">
      <Navbar />
      <main class="p-6 pt-0 bg-gray-900 flex-1 overflow-auto">
        <router-view></router-view>
      </main>
    </div>
  </div>
</template>

<script setup>
import Sidebar from "../components/Sidebar.vue";
import Navbar from "../components/Navbar.vue";
</script>
