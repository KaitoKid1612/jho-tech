<template>
  <div class="mb-4">
    <label class="block text-gray-400 text-sm mb-2">{{ label }}</label>
    <input
      v-model="internalValue"
      :type="type"
      class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700"
    />
  </div>
</template>

<script setup>
import { ref, watch } from "vue";

const props = defineProps({
  label: String,
  modelValue: String,
  type: {
    type: String,
    default: "text",
  },
});

// Tạo biến local để lưu giá trị input
const internalValue = ref(props.modelValue);

// Khi modelValue thay đổi từ cha, cập nhật lại biến local
watch(() => props.modelValue, (newValue) => {
  internalValue.value = newValue;
});
</script>
