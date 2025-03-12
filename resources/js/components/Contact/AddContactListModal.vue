<template>
  <Teleport to="body">
    <div v-if="isOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-[#09091A] w-[600px] rounded-lg shadow-lg p-6 relative">
        <!-- Close Button -->
        <button @click="closeModal" class="absolute top-3 right-3 text-gray-400 hover:text-white">
          ✕
        </button>

        <!-- Modal Title -->
        <h2 class="text-white text-lg font-semibold flex items-center gap-2">
          <img src="/images/icon/bull-list.png" alt="List Icon" class="w-5 h-5" />
          Ajouter liste
        </h2>

        <!-- Input Fields -->
        <div class="mt-4 space-y-4">
          <input
            v-model="listName"
            type="text"
            placeholder="Votre liste"
            class="w-full p-3 bg-gray-700 text-white rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#f85149]"
          />
        </div>

        <!-- Add More Button -->
        <div class="mt-4 flex items-center justify-between border border-dashed border-gray-500 p-3 rounded-md cursor-pointer hover:border-gray-400" @click="addMoreList">
          <span class="text-gray-300">Ajouter une liste</span>
          <button class="bg-gray-600 hover:bg-gray-500 text-white rounded-full p-1">
            +
          </button>
        </div>

        <!-- Dynamic List Inputs -->
        <div v-for="(list, index) in additionalLists" :key="index" class="mt-2 flex items-center gap-2">
          <input
            v-model="additionalLists[index]"
            type="text"
            placeholder="Votre liste"
            class="w-full p-3 bg-gray-700 text-white rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#f85149]"
          />
          <button @click="removeList(index)" class="text-gray-400 hover:text-red-500">
            🗑
          </button>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-between items-center">
          <button @click="closeModal" class="text-gray-400 hover:text-white">Annuler</button>
          <button @click="saveList" class="bg-[#DD5313] hover:bg-[#f85149] text-white py-2 px-4 rounded-md">
            Sauvegarder
          </button>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, defineProps, defineEmits } from "vue";

// Props
defineProps({
  isOpen: Boolean,
});

// Emits
const emit = defineEmits(["close", "save"]);

// State Variables
const listName = ref("");
const additionalLists = ref([]);

// Functions
const closeModal = () => {
  emit("close");
};

const addMoreList = () => {
  additionalLists.value.push("");
};

const removeList = (index) => {
  additionalLists.value.splice(index, 1);
};

const saveList = () => {
  if (!listName.value.trim()) {
    alert("Le nom de la liste ne peut pas être vide!");
    return;
  }

  const newLists = [listName.value, ...additionalLists.value].filter((list) => list.trim() !== "");

  emit("save", newLists);
  closeModal();
};
</script>

<style scoped>
/* Custom modal styling if needed */
</style>
