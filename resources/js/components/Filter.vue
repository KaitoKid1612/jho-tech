<template>
    <div class="flex items-center gap-4">
        <!-- Select 1 -->
        <div class="relative flex-1 max-w-[407px] max-h-[40px]">
            <img src="/images/icon/preferences.png" alt="Filter"
                class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-500" />
            <select v-model="filter1"
                class="w-full pl-8 pr-3 py-2 bg-transparent text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]">
                <option value="1">Plus de filtre</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <!-- Select 2 -->
        <div class="relative flex-1 max-w-[407px] max-h-[40px]">
            <img src="/images/icon/users.png" alt="Users" class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-500" />
            <select v-model="filter2"
                class="w-full pl-8 pr-3 py-2 bg-transparent text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]">
                <option value="1">Tout le monde</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <!-- Search Input -->
        <div class="relative flex-1 max-w-[407px] max-h-[40px]">
            <img src="/images/icon/search.png" class="absolute left-2.5 top-2.5 w-4 h-4 text-white" />
            <input
                v-model="filters.search"
                @input="applyFilter"
                placeholder="Search contacts..."
                class="w-full pl-8 pr-3 py-2 bg-transparent text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]"
                type="search"
            />
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
                    <li @click="openContactListModal" class="cursor-pointer p-2 hover:bg-gray-700 rounded-lg">Créer /
                        Editer une Liste</li>
                    <li @click="isDropdownOpen = false" class="cursor-pointer p-2 hover:bg-gray-700 rounded-lg">Créer /
                        Editer une Etiquette</li>
                    <li @click="openExportResultModal" class="cursor-pointer p-2 hover:bg-gray-700 rounded-lg">
                        Exporter
                        les résultats du filtre...</li>
                    <li @click="isDropdownOpen = false" class="cursor-pointer p-2 hover:bg-gray-700 rounded-lg">Importer
                        des données</li>
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
import {
    ref
} from "vue";
import ContactListModal from "./Contact/ContactListModal.vue";
import ExportResultsModal from "./Contact/ExportResultsModal.vue";
import { useContactsStore } from "../store/contacts";

const contactsStore = useContactsStore();

const filter1 = ref("1");
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

const filters = ref({
    search: "",
    email: "",
    manager: "",
    tags: "",
    created_at: "",
});

const applyFilter = () => {
    contactsStore.searchContacts({
        ...filters.value,
        tags: filters.value.tags ? filters.value.tags.split(",") : []
    });
};
</script>
