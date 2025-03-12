<template>
  <form @submit.prevent="onSubmit" class="space-y-4">
    <!-- Error Message -->
    <p v-if="errorMessage" class="text-red-500 text-xs">{{ errorMessage }}</p>

    <!-- Name Field -->
    <div>
      <label class="block text-gray-400">Name</label>
      <input v-model="formData.name" type="text" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700" />
      <p v-if="errors.name" class="text-red-500 text-xs">{{ errors.name }}</p>
    </div>

    <!-- Email Field -->
    <div>
      <label class="block text-gray-400">Email</label>
      <input v-model="formData.email" type="email" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700" />
      <p v-if="errors.email" class="text-red-500 text-xs">{{ errors.email }}</p>
    </div>

    <!-- Phone Field -->
    <div>
      <label class="block text-gray-400">Phone</label>
      <input v-model="formData.phone" type="text" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-700" />
      <p v-if="errors.phone" class="text-red-500 text-xs">{{ errors.phone }}</p>
    </div>

    <!-- Manager Dropdown -->
    <div>
      <label class="block text-gray-400">Manager</label>
      <vue-multiselect
        v-model="formData.managed_by"
        :options="managers"
        track-by="id"
        label="name"
        placeholder="Select a manager"
        class="text-black"
      />
      <p v-if="errors.managed_by" class="text-red-500 text-xs">{{ errors.managed_by }}</p>
    </div>

    <!-- Tags Multi-Select -->
    <div>
      <label class="block text-gray-400">Tags</label>
      <vue-multiselect
        v-model="formData.tags"
        :options="tags"
        multiple
        track-by="id"
        label="name"
        placeholder="Select tags"
        class="text-black"
      />
    </div>

    <!-- Buttons -->
    <div class="flex justify-end space-x-2">
      <button type="button" @click="onClose" class="bg-gray-600 py-2 px-4 rounded">
        Cancel
      </button>
      <button type="submit" class="bg-[#DD5313] text-white py-2 px-4 rounded">
        Add Contact
      </button>
    </div>
  </form>
</template>

<script setup>
import { ref, computed, defineProps, defineEmits, onMounted } from "vue";
import { useContactsStore } from "../../store/contacts";
import { useTagsStore } from "../../store/tags";
import VueMultiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";

const props = defineProps({
  onClose: Function,
  onSuccess: Function,
});

const emit = defineEmits(["close", "success"]);

const contactsStore = useContactsStore();
const tagsStore = useTagsStore();

const formData = ref({
  name: "",
  email: "",
  phone: "",
  managed_by: null,
  tags: [],
});

const errors = ref({});
const errorMessage = ref("");

const tags = computed(() => tagsStore.tags);

onMounted(() => {
  tagsStore.fetchTags();
});

const validateForm = () => {
  errors.value = {};
  if (!formData.value.name) errors.value.name = "Name is required";
  if (!formData.value.email) errors.value.email = "Email is required";
  if (!formData.value.phone) errors.value.phone = "Phone is required";
  return Object.keys(errors.value).length === 0;
};

const onSubmit = async () => {
  if (!validateForm()) return;
  try {
    await contactsStore.addContact(formData.value);
    emit("success");
    emit("close");
  } catch (error) {
    errorMessage.value = error.message || "An error occurred";
  }
};
</script>

<style>
/* Vue Multiselect Custom Styling */
.vue-multiselect {
  background: white;
  color: black;
  border-radius: 4px;
}
</style>
