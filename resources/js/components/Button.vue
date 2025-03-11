<template>
  <button
    @click="$emit('click')"
    class="bg-orange-600 hover:bg-orange-500 text-white py-2 px-4 rounded"
    :class="className"
  >
    <slot></slot>
  </button>
</template>

<script setup>
defineProps({
  className: String,
});

defineEmits(["click"]);
</script>
