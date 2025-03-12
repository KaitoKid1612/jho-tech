<template>
    <div class="flex items-center gap-4">
        <!-- Filter theo Manager -->
        <div class="relative flex-1 max-w-[200px]">
            <img src="/images/icon/preferences.png" class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-500" />
            <select v-model="filters.manager" @change="applyFilter"
                class="w-full pl-8 pr-3 py-2 bg-transparent text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]">
                <option value="">Plus de filtre</option>
                <option v-for="manager in managers" :key="manager.id" :value="manager.id">
                    {{ manager.name }}
                </option>
            </select>
        </div>

        <!-- Filter theo Người tạo -->
        <div class="relative flex-1 max-w-[200px]">
            <img src="/images/icon/users.png" class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-500" />
            <select v-model="filters.createdBy" @change="applyFilter"
                class="w-full pl-8 pr-3 py-2 bg-transparent text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]">
                <option value="">Tout le monde</option>
                <option v-for="creator in creators" :key="creator.id" :value="creator.id">
                    {{ creator.name }}
                </option>
            </select>
        </div>

        <!-- Filter theo Tag -->
        <div class="relative flex-1 max-w-[200px]">
            <img src="/images/icon/tag.png" class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-500" />
            <select v-model="filters.tag" @change="applyFilter"
                class="w-full pl-8 pr-3 py-2 bg-transparent text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]">
                <option value="">Tous les tags</option>
                <option v-for="tag in tags" :key="tag.id" :value="tag.id">
                    {{ tag.name }}
                </option>
            </select>
        </div>

        <!-- Search Input -->
        <div class="relative flex-1 max-w-[300px]">
            <img src="/images/icon/search.png" class="absolute left-2.5 top-2.5 w-4 h-4 text-white" />
            <input v-model="filters.search" @input="applyFilter"
                placeholder="Titre, contact, responsable..."
                class="w-full pl-8 pr-3 py-2 bg-transparent text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]"
                type="search"
            />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useContactsStore } from "../store/contacts";
import { useTagsStore } from "../store/tags";

const contactsStore = useContactsStore();
const tagsStore = useTagsStore();
const filters = ref({
    search: "",
    manager: "",
    createdBy: "",
    tag: ""
});

const managers = ref([]);
const creators = ref([]);
const tags = ref([]);

onMounted(async () => {
    await contactsStore.fetchCreators();
    creators.value = contactsStore.creators;

    await tagsStore.fetchTags();
    tags.value = tagsStore.tags;
});

const applyFilter = () => {
    contactsStore.searchContacts(filters.value);
};
</script>
