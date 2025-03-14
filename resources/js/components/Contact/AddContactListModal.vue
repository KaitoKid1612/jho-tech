<template>
    <Teleport to="body">
        <div v-if="isOpen" class="fixed inset-0 bg-[#2E374580] bg-opacity-50 z-50 flex items-center justify-center">
            <div
                class="relative bg-[#09091A] w-[822px] rounded-lg px-[138px] py-11 border border-white border-opacity-20">
                <button @click="closeModal" class="absolute top-6 right-6 block">
                    <img src="/images/icon/Close remove 2.svg" alt="Close" />
                </button>

                <!-- Modal Title -->
                <div class="flex items-center">
                    <img src="/images/icon/Bulleted list.svg" alt="List Icon" class="w-4.5 h-4.5 mr-2" />
                    <span class="text-white text-2xl font-bold">Ajouter liste</span>
                </div>

                <!-- Input Fields -->
                <div class="flex flex-col gap-2 mt-8">
                    <div class="relative">
                        <input v-model="listName" type="text" value="Votre liste" class="w-full rounded-lg p-3 bg-gray-700 text-white text-xs border border-gray-600
                   focus:outline-none focus:ring-2 focus:ring-[#f85149]" />
                        <img src="/images/icon/Delete 2.svg" alt="Delete"
                            class="absolute w-4 h-4 top-3 right-3 cursor-pointer" />
                    </div>

                    <div class="relative">
                        <input v-model="listName" type="text" value="Votre liste" class="w-full rounded-lg p-3 bg-gray-700 text-white text-xs border border-gray-600
                   focus:outline-none focus:ring-2 focus:ring-[#f85149]" />
                        <img src="/images/icon/Delete 2.svg" alt="Delete"
                            class="absolute w-4 h-4 top-3 right-3 cursor-pointer" />
                    </div>
                </div>

                <!-- Add More Button -->
                <button class="relative w-[204px] mt-2 flex items-center justify-between border border-dashed border-gray-500 p-3 rounded-md cursor-pointer hover:border-gray-400"
                    @click="addMoreList">
                    <span class="text-xs text-white">Ajouter une liste</span>
                    <img src="/images/icon/Plus 1 4.svg" alt="Delete"
                            class="absolute w-4.5 h-4.5 top-3 right-3 cursor-pointer" />
                </button>

                <!-- Dynamic List Inputs -->
                <div v-for="(list, index) in additionalLists" :key="index" class="mt-2 flex items-center gap-2">
                    <input v-model="additionalLists[index]" type="text" placeholder="Votre liste"
                        class="w-full p-3 bg-gray-700 text-white rounded-md border border-gray-600 focus:outline-none focus:ring-2 focus:ring-[#f85149]" />
                    <button @click="removeList(index)" class="text-gray-400 hover:text-red-500">
                        🗑
                    </button>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 mb-12 flex justify-between items-center">
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
