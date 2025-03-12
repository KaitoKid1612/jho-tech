<template>
    <Teleport to="body">
        <div v-if="isOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-[#1E2A38] w-[600px] rounded-lg shadow-lg p-6">
                <!-- Header -->
                <div class="flex justify-between items-center border-b border-gray-600 pb-3">
                <img src="/images/icon/bull-list.png" alt="List Icon" class="w-5 h-5" />
                    <h2 class="text-white text-xl font-semibold">Liste de contact</h2>
                    <button @click="closeModal" class="text-gray-400 hover:text-white">
                        ✖
                    </button>
                </div>

                <!-- Search and Add Button -->
                <div class="flex items-center gap-4 mt-4">
                    <div class="relative flex-1">
                        <img src="/images/icon/search.png" alt="Search"
                            class="absolute left-2.5 top-2.5 w-4 h-4 text-gray-500" />
                        <input v-model="searchQuery" placeholder="Recherche" type="search"
                            class="w-full pl-8 pr-3 py-2 bg-[#232B39] text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]" />
                    </div>
                    <button @click="openAddContactListModal"
                        class="bg-orange-600 hover:bg-orange-500 text-white py-2 px-4 rounded flex items-center gap-2">
                        <img src="/images/icon/plus.png" alt="Add" class="w-4 h-4" />
                        Ajouter une liste
                    </button>
                </div>

                <!-- Contact List -->
                <table class="min-w-full divide-y divide-gray-700 text-sm mt-4">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Nom de la liste
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">
                                Contact
                            </th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        <tr v-for="(list, index) in filteredLists" :key="index" class="hover:bg-gray-800">
                            <td class="px-6 py-4 text-white">{{ list.name }}</td>
                            <td class="px-6 py-4 text-gray-300">{{ list.count }}</td>
                            <td class="px-6 py-4 text-right">
                                <button @click="openEditContactListModal"
                                    class="bg-[#1E2A38] border border-[#0fd2d5] px-3 py-1 rounded-lg text-white flex items-center gap-2">
                                    <img src="/images/icon/edit.png" alt="Edit" class="w-4 h-4" />
                                    Modifier
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <AddContactListModal :isOpen="isAddListModalOpen" @close="isAddListModalOpen = false" @save="handleSaveList" />
        <EditContactListModal :isOpen="isEditModalOpen" :listName="selectedListName" @close="isEditModalOpen = false"
            @save="handleSaveChanges" @delete="handleDeleteList" />
    </Teleport>
</template>

<script setup>
import { ref, computed } from "vue";
import AddContactListModal from "./AddContactListModal.vue";
import EditContactListModal from "./EditContactListModal.vue";

const props = defineProps({
    isOpen: Boolean,
});

const isAddListModalOpen = ref(false);
const isEditModalOpen = ref(false);
const selectedListName = ref("");

const emit = defineEmits(["close"]);

const searchQuery = ref("");
const contactLists = ref([
    { name: "Liste", count: 165 },
    { name: "Liste", count: 165 },
    { name: "Liste", count: 165 },
    { name: "Liste", count: 165 },
    { name: "Liste", count: 165 },
]);

const filteredLists = computed(() => {
    return contactLists.value.filter((list) =>
        list.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const closeModal = () => {
    emit("close");
};

const openAddContactListModal = () => {
    isAddListModalOpen.value = true;
};

const openEditContactListModal = () => {
    isEditModalOpen.value = true;
};
</script>
