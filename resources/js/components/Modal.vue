<template>
  <Teleport to="body">
    <div v-if="isOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-[#1E2A38] p-6 rounded-lg shadow-lg w-[400px] relative">
        <button
          @click="onClose"
          class="absolute top-2 right-2 text-white bg-red-600 hover:bg-red-500 rounded-full p-1"
        >
          ✕
        </button>
        <slot></slot>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
defineProps({
  isOpen: Boolean,
  onClose: Function,
});
</script>
