<template>
  <Teleport to="body">
    <div v-if="isOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-[#13131a] w-[600px] rounded-lg shadow-lg p-6 relative">

        <!-- Close Button -->
        <button @click="closeModal" class="absolute top-3 right-3 text-gray-400 hover:text-white">
          ✕
        </button>

        <!-- Modal Title -->
        <h2 class="text-white text-lg font-semibold">Exporter les résultats</h2>

        <!-- Format Selection -->
        <div class="mt-4 text-white">
          <h3 class="font-medium">Choisir un format pour l'exportation</h3>
          <label class="flex items-center gap-2 mt-2">
            <input type="radio" v-model="exportFormat" value="xlsx" class="form-radio text-orange-500" />
            <span>XLSX (Excel)</span>
          </label>
          <label class="flex items-center gap-2 mt-2">
            <input type="radio" v-model="exportFormat" value="csv" class="form-radio text-orange-500" />
            <span>CSV (valeurs séparées par des virgules)</span>
          </label>
          <p class="text-gray-400 text-sm mt-1">Tous les {{ totalItems }} éléments seront exportés.</p>
        </div>

        <!-- Export File Name -->
        <div class="mt-4">
          <label class="block text-white font-medium">Nom de l'exportation (facultatif)</label>
          <input
            v-model="exportFileName"
            type="text"
            placeholder="Nom de l’exportation (il s'agit du nom du fichier exporté)"
            class="w-full p-3 bg-gray-700 text-white rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#f85149]"
          />
        </div>

        <!-- Field Selection -->
        <div class="mt-4 text-white">
          <h3 class="font-medium">Sélectionnez les fichiers à exporter</h3>
          <label class="flex items-center gap-2 mt-2">
            <input type="radio" v-model="exportFields" value="default" class="form-radio text-orange-500" />
            <span>Champs par défaut</span>
          </label>
          <label class="flex items-center gap-2 mt-2">
            <input type="radio" v-model="exportFields" value="custom" class="form-radio text-orange-500" />
            <span>Autres champs</span>
          </label>

          <!-- Custom Field Selection -->
          <div v-if="exportFields === 'custom'" class="mt-3 space-y-2 pl-4">
            <label v-for="field in customFields" :key="field.value" class="flex items-center gap-2">
              <input type="checkbox" v-model="selectedFields" :value="field.value" class="form-checkbox text-orange-500" />
              <span>{{ field.label }}</span>
            </label>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-between items-center">
          <button @click="closeModal" class="text-gray-400 hover:text-white">Annuler</button>
          <button @click="exportData" class="bg-[#DD5313] hover:bg-[#f85149] text-white py-2 px-6 rounded-md">
            Exportation
          </button>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, defineProps, defineEmits } from "vue";

// Props
const props = defineProps({
  isOpen: Boolean,
  totalItems: {
    type: Number,
    default: 0,
  },
});

// Emits
const emit = defineEmits(["close", "export"]);

// State Variables
const exportFormat = ref("xlsx");
const exportFileName = ref("");
const exportFields = ref("default");
const selectedFields = ref([]);

// Available custom fields
const customFields = [
  { value: "tags", label: "Étiquettes" },
  { value: "list", label: "Liste" },
  { value: "custom_fields", label: "Champs personnalisés" },
  { value: "accounts", label: "Comptes" },
  { value: "score", label: "Score" },
];

// Functions
const closeModal = () => {
  emit("close");
};

const exportData = () => {
  const exportOptions = {
    format: exportFormat.value,
    fileName: exportFileName.value || `Export_${new Date().toISOString()}`,
    fields: exportFields.value === "default" ? ["default"] : selectedFields.value,
  };

  emit("export", exportOptions);
  closeModal();
};
</script>

<style scoped>
/* Custom styling if needed */
</style>
