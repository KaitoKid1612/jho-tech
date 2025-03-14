<template>
    <div class="flex items-center gap-4">
        <div class="relative flex-1 max-w-[200px] h-10">
            <img src="/images/icon/preferences.png" class="absolute left-2.5 top-2.5 w-4.5 h-4.5" />
            <select v-model="filters.manager" @change="applyFilter"
                class="w-full h-full pl-8 pr-8 bg-transparent text-[10px] appearance-none border border-[#273140] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]">
                <option value="">Plus de filtre</option>
                <option v-for="manager in managers" :key="manager.id" :value="manager.id">
                    {{ manager.name }}
                </option>
            </select>
            <img src="/images/icon/arrow-down.svg" class="absolute right-2.5 top-2.5 w-4.5 h-4.5" />
        </div>

        <div class="relative flex-1 max-w-[200px] h-10">
            <img src="/images/icon/2 User 2.svg" class="absolute left-2.5 top-2.5 w-4.5 h-4.5" />
            <select v-model="filters.createdBy" @change="applyFilter"
                class="w-full h-full pl-8 pr-8 bg-transparent text-[10px] appearance-none border border-[#273140] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]">
                <option value="">Tout le monde</option>
                <!-- <option v-for="creator in creators" :key="creator.id" :value="creator.id">
                    {{ creator.name }}
                </option> -->
            </select>
            <img src="/images/icon/arrow-down.svg" class="absolute right-2.5 top-2.5 w-4.5 h-4.5" />
        </div>

        <div class="relative flex-1 max-w-[200px] h-10">
            <img src="/images/icon/Tag 1.svg" class="absolute left-2.5 top-2.5 w-4.5 h-4.5" />
            <select v-model="filters.tag" @change="applyFilter"
                class="w-full h-full pl-8 pr-8 bg-transparent text-[10px] appearance-none border border-[#273140] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]">
                <option value="">Tous les tags</option>
                <option v-for="tag in tags" :key="tag.id" :value="tag.id">
                    {{ tag.name }}
                </option>
            </select>
            <img src="/images/icon/arrow-down.svg" class="absolute right-2.5 top-2.5 w-4.5 h-4.5" />
        </div>

        <!-- Search Input -->
        <div class="relative flex-1 max-w-[300px] h-10">
            <img src="/images/icon/Search 2.svg" class="absolute left-2.5 top-2.5 w-4 h-4 text-white" />
            <input v-model="filters.search" @input="applyFilter" placeholder="Titre, contact, responsable..."
                class="w-full h-full pl-8 bg-transparent text-[10px] border border-[#273140] rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]"
                type="search" />
        </div>

        <!-- Settings Button -->
        <div class="relative">
            <button @click="isDropdownOpen = !isDropdownOpen"
                class="border border-gray-700 rounded-lg w-8 h-8 flex items-center justify-center">
                <img src="/images/icon/setting.png" alt="Settings" class="w-4 h-4 text-white" />
            </button>

            <div v-if="isDropdownOpen"
                class="absolute right-0 mt-2 w-52 bg-gray-900 rounded-lg shadow-lg z-50 border border-gray-600">
                <ul class="text-white p-4 space-y-2 text-sm">
                    <li @click="openContactListModal" class="cursor-pointer p-2 hover:bg-gray-700 rounded-lg">
                        Créer / Editer une Liste
                    </li>
                    <li @click="isDropdownOpen = false" class="cursor-pointer p-2 hover:bg-gray-700 rounded-lg">
                        Créer / Editer une Etiquette
                    </li>
                    <li @click="openExportResultModal" class="cursor-pointer p-2 hover:bg-gray-700 rounded-lg">
                        Exporter les résultats du filtre...
                    </li>
                    <li @click="isDropdownOpen = false" class="cursor-pointer p-2 hover:bg-gray-700 rounded-lg">
                        Importer des données
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contact List Modal -->
        <ContactListModal :isOpen="isContactListModalOpen" @close="isContactListModalOpen = false" />
        <ExportResultsModal :isOpen="isExportModalOpen" :totalItems="88" @close="isExportModalOpen = false"
            @export="handleExport" />
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useContactsStore } from "../store/contacts";
import { useTagsStore } from "../store/tags";
import ContactListModal from "./Contact/ContactListModal.vue";
import ExportResultsModal from "./Contact/ExportResultsModal.vue";

const contactsStore = useContactsStore();
const tagsStore = useTagsStore();
const filters = ref({
    search: "",
    manager: "",
    createdBy: "",
    tag: "",
});

const managers = ref([]);
const tags = ref([]);

onMounted(async () => {
    await tagsStore.fetchTags();
    tags.value = tagsStore.tags;
});

const applyFilter = () => {
    contactsStore.searchContacts(filters.value);
};

const isDropdownOpen = ref(false);
const isContactListModalOpen = ref(false);
const openContactListModal = () => {
    isDropdownOpen.value = false;
    isContactListModalOpen.value = true;
};

const isExportModalOpen = ref(false);
const openExportResultModal = () => {
    isDropdownOpen.value = false;
    isExportModalOpen.value = true;
};
</script>

<style scoped></style>
