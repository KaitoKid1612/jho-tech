<template>
    <div v-if="isOpen" class="fixed inset-0 bg-black bg-opacity-50 flex justify-end">
        <div
            class="bg-[#0F172A] p-6 rounded-l-lg shadow-lg w-[50vw] h-screen fixed right-0 top-0 transition-all duration-300 transform translate-x-0">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-6 border-b border-gray-600 pb-3">
                <h2 class="text-white text-lg font-semibold">Éditer tâche</h2>
                <button @click="closeModal" class="text-gray-400 hover:text-white text-2xl">&times;</button>
            </div>

            <!-- Form Edit Task -->
            <div class="space-y-6 overflow-y-auto h-[calc(100vh-100px)] pr-4">
                <!-- Task Title -->
                <div>
                    <label class="text-gray-400 text-sm block mb-1">Titre de la tâche</label>
                    <input v-model="task.title"
                        class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        placeholder="Entrez le titre de la tâche" />
                </div>

                <!-- Due Date & Time -->
                <div class="flex gap-4">
                    <div class="w-1/2">
                        <label class="text-gray-400 text-sm block mb-1">Date d'échéance</label>
                        <input type="date" v-model="task.due_date"
                            class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-500" />
                    </div>
                    <div class="w-1/2">
                        <label class="text-gray-400 text-sm block mb-1">Heure</label>
                        <input type="time" v-model="task.time"
                            class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-500" />
                    </div>
                </div>

                <!-- Note -->
                <div>
                    <label class="text-gray-400 text-sm block mb-1">Note</label>
                    <textarea v-model="task.note"
                        class="w-full p-3 h-24 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-500 resize-none"
                        placeholder="Ajoutez une note..."></textarea>
                </div>

                <!-- Responsable -->
                <div>
                    <label class="text-gray-400 text-sm block mb-1">Responsable</label>
                    <select v-model="task.responsible"
                        class="w-full p-3 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option v-for="user in users" :key="user.id" :value="user.name">
                            {{ user.name }}
                        </option>
                    </select>
                </div>

                <!-- Footer Modal -->
                <div class="flex justify-between items-center mt-6">
                    <button @click="markAsDone" class="text-gray-400 hover:text-white text-sm">
                        ✅ Marquer comme réalisée
                    </button>
                    <div class="flex gap-3">
                        <button @click="closeModal"
                            class="bg-gray-600 hover:bg-gray-500 text-white py-2 px-5 rounded-lg transition">
                            Annuler
                        </button>
                        <button @click="saveTask"
                            class="bg-orange-600 hover:bg-orange-500 text-white py-2 px-5 rounded-lg transition">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits, ref, watch } from "vue";

const props = defineProps({
    isOpen: Boolean,
    taskData: Object,
    users: Array
});

const emit = defineEmits(["close", "save"]);
const task = ref({});

watch(() => props.taskData, (newData) => {
    task.value = { ...newData };
}, { deep: true });

const closeModal = () => emit("close");
const saveTask = () => emit("save", task.value);
const markAsDone = () => {
    task.value.status = "Done";
    saveTask();
};
</script>

<style scoped>
.fixed {
    transition: transform 0.3s ease-in-out;
}
</style>
