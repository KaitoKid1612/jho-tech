<template>
    <Teleport to="body">
        <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center bg-[#2E3B4C] bg-opacity-50 z-50">
            <div
                class="relative bg-[#09091A] w-[822px] rounded-lg px-[138px] py-11 border border-white border-opacity-20">
                <button @click="closeModal" class="absolute top-6 right-6 block">
                    <img src="/images/icon/Close remove 2.svg" alt="Close" />
                </button>
                <!-- Header -->
                <div class="flex items-center">
                    <img src="/images/icon/Bulleted list.svg" alt="List Icon" class="w-4.5 h-4.5 mr-2" />
                    <span class="text-white text-2xl font-bold leading-[26px] w-32">Liste <br> de contact</span>
                    <div class="relative flex-1 ml-5">
                        <img src="/images/icon/search.png" alt="Search"
                            class="absolute left-2.5 top-[14px] w-4 h-4 text-gray-500" />
                        <input v-model="searchQuery" placeholder="Recherche" type="search"
                            class="w-[156px] pl-8 py-3 bg-[#232B39] text-[12px] border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-[#f85149]" />
                    </div>
                    <button @click="openAddContactListModal"
                        class="bg-orange-600 hover:bg-orange-500 py-3 px-10 rounded-lg flex items-center gap-1 ml-3">
                        <img src="/images/icon/Plus 1 1.svg" alt="Add" class="w-4.5 h-4.5" />
                        <span class="text-white text-xs">Ajouter une liste</span>
                    </button>
                </div>

                <!-- Contact List -->
                <table class="min-w-full divide-y divide-gray-700 text-sm mt-5">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="w-[284px] py-2 text-left text-xs text-[#8B8B8B]">
                                <span class="font-normal">
                                    Nom de la liste
                                </span>
                            </th>
                            <th class="w-[218px] py-2 text-left text-xs text-[#8B8B8B]">
                                <span class="font-normal">
                                    Contact
                                </span>
                            </th>
                            <th class="py-2"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 border-b border-gray-700">
                        <tr v-for="(list, index) in filteredLists" :key="index" class="hover:bg-gray-800">
                            <td class="w-[284px] py-6 text-white font-bold text-xs">{{ list.name }}</td>
                            <td class="w-[218px] py-6 text-white font-bold text-xs">{{ list.count }}</td>
                            <td class="flex gap-1 px-6 py-4 text-center text-gray-400">
                                <button @click="openEditContactListModal" class="hover:text-white">
                                    <img src="/images/icon/edit.png" alt="Edit" class="w-4 h-4 max-w-none" />
                                </button>
                                <button class="hover:text-red-600" @click="handleDeleteContact(contact.id)">
                                    <img src="/images/icon/trash.png" alt="Delete" class="w-4 h-4 max-w-none" />
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
