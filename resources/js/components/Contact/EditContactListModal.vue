<template>
  <Teleport to="body">
    <div v-if="isOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-[#13131a] w-[600px] rounded-lg shadow-lg p-6 relative">
        <!-- Close Button -->
        <button @click="closeModal" class="absolute top-3 right-3 text-gray-400 hover:text-white">
          ✕
        </button>

        <!-- Modal Title -->
        <h2 class="text-white text-lg font-semibold flex items-center gap-2">
          <img src="/images/icon/bull-list.png" alt="List Icon" class="w-5 h-5" />
          Modifier liste
        </h2>

        <!-- Input Field -->
        <div class="mt-4">
          <input
            v-model="editedListName"
            type="text"
            placeholder="Votre liste"
            class="w-full p-3 bg-gray-700 text-white rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#f85149]"
          />
        </div>

        <!-- Delete Button -->
        <div class="mt-4 flex justify-end">
          <button @click="deleteList" class="text-gray-400 hover:text-red-500 flex items-center gap-2">
            🗑 Supprimer
          </button>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-between items-center">
          <button @click="closeModal" class="text-gray-400 hover:text-white">Annuler</button>
          <button @click="saveChanges" class="bg-[#DD5313] hover:bg-[#f85149] text-white py-2 px-4 rounded-md">
            Sauvegarder
          </button>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, defineProps, defineEmits, watch } from "vue";

// Props
const props = defineProps({
  isOpen: Boolean,
  listName: String,
});

// Emits
const emit = defineEmits(["close", "save", "delete"]);

// State Variables
const editedListName = ref(props.listName);

watch(() => props.listName, (newValue) => {
  editedListName.value = newValue;
});

// Functions
const closeModal = () => {
  emit("close");
};

const saveChanges = () => {
  if (!editedListName.value.trim()) {
    alert("Le nom de la liste ne peut pas être vide!");
    return;
  }
  emit("save", editedListName.value);
  closeModal();
};

const deleteList = () => {
  if (confirm("Êtes-vous sûr de vouloir supprimer cette liste?")) {
    emit("delete", editedListName.value);
    closeModal();
  }
};
</script>

<style scoped>
/* Custom modal styling if needed */
</style>
