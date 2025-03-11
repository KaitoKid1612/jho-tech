<template>
  <div class="flex min-h-screen">
    <Sidebar />
    <div class="flex flex-col flex-1">
      <Navbar />
      <main class="p-6 bg-gray-900 flex-1 overflow-auto">
        <slot></slot>
      </main>
    </div>
  </div>
</template>

<script setup>
import Sidebar from "../components/Sidebar.vue";
import Navbar from "../components/Navbar.vue";
</script>
