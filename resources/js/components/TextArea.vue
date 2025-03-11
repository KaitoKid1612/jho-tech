<template>
  <div class="mb-4">
    <label class="block text-gray-400 text-sm mb-2">{{ label }}</label>
    <textarea
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700"
    ></textarea>
  </div>
</template>

<script setup>
defineProps({
  label: String,
  modelValue: String,
});

defineEmits(["update:modelValue"]);
</script>
