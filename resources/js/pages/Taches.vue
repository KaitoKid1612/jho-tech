<template>
    <NavigationTabs />
    <div class="flex justify-between items-center pb-4 mt-7">
        <div class="flex items-center gap-3">
            <button class="bg-orange-600 hover:bg-orange-500 text-white py-3 px-10 rounded-xl flex items-center gap-2"
                @click="isModalOpen = true">
                <img src="/images/icon/plus.png" alt="Add Task" class="left-2.5 top-2.5 w-4 h-4 text-white" />
                <p class="text-xs">Ajouter une tâche</p>
            </button>
            <p class="text-white text-sm font-semibold">
                {{ tasksStore.total }} <span class="text-gray-400 font-normal">tâches</span>
            </p>
        </div>
        <Filter />
    </div>

    <div class="flex items-center gap-3 text-[#8B8B8B] text-xs">
        <span>Tout</span>
        <div class="flex items-center gap-1 border p-1 rounded-lg text-white">
            <img src="/images/icon/message.png" alt="Filter" class="w-3 h-3" />
            <span>Appel</span>
        </div>
        <div class="flex items-center gap-1">
            <img src="/images/icon/call.png" alt="Filter" class="w-3 h-3" />
            <span>E-mail</span>
        </div>
        <span class="border p-1 rounded-lg text-white">En retard</span>
        <span>Aujourd’hui</span>
        <span>Demain</span>
        <span>P1</span>
        <span>P2</span>
        <span>P3</span>
    </div>

    <div class="bg-[#17202E] p-6 rounded-lg shadow-lg mt-5">
        <!-- Loading -->
        <div v-if="tasksStore.loading" class="flex justify-center py-10">
            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path fill="currentColor" d="M4 12a8 8 0 018-8v8h8"></path>
            </svg>
        </div>

        <!-- Tasks List -->
        <table v-else class="min-w-full divide-y divide-gray-700 text-sm">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">
                        <input type="checkbox" v-model="selectAll" @change="toggleSelectAll"
                            class="w-4 h-4 text-red-600 border-gray-300 rounded-lg" />
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Réalisé</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Titre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Date d'échéance</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Opportunité</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Contact associé</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Responsable</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Date de création</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-400 tracking-wider text-center">
                        <img src="/images/icon/setting.png" alt="Settings" class="w-4 h-4 text-white max-w-none" />
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 text-xs leading-[16px]">
                <tr v-for="task in tasksStore.tasks" :key="task.id" class="hover:bg-gray-800">
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        <input type="checkbox" v-model="selectedTasks" :value="task.id"
                            class="w-4 h-4 text-red-600 border-gray-300 rounded-lg" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        <img src="/images/icon/check.png" alt="Settings" class="w-4 h-4 text-white max-w-none" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ task.title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ task.due_date || '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                        <div class="flex items-center gap-2">
                            <img src="/images/icon/message.png" alt="Email" class="w-4 h-4 text-white max-w-none" />
                            <span>{{ task.contact?.email }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                        <div class="flex items-center gap-2">
                            <img src="/images/icon/call.png" alt="Phone" class="w-4 h-4 text-white max-w-none" />
                            <span>{{ task.contact?.phone }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ task.status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ task.contact?.name || '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                        <div class="flex items-center gap-2">
                            <img src="/images/icon/avatar.png" alt="Phone" class="w-4 h-4 text-white max-w-none" />
                            {{ task.user?.name || '-' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ task.created_at }}</td>
                    <td class="flex gap-1 px-6 py-4 whitespace-nowrap text-center text-gray-400">
                        <button @click="handleEditTask(task)" class="hover:text-white">
                            <img src="/images/icon/edit.png" alt="Edit" class="w-4 h-4 text-white max-w-none" />
                        </button>
                        <button class="hover:text-red-600" @click="handleDeleteTask(task.id)">
                            <img src="/images/icon/trash.png" alt="Delete" class="w-4 h-4 text-white max-w-none" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-between items-center pt-4 text-gray-400 text-sm">
        <div class="flex items-center space-x-3">
            Éléments par page:&nbsp;<div
                class="p-2 flex gap-1 justify-center items-center border border-[#273140] rounded-lg">{{
                    tasksStore.perPage }} <img class="h-3" src="/images/icon/arrow-down.png" alt="">
            </div>
            <span class="font-semibold text-white">{{ tasksStore.from }}-{{ tasksStore.to }}&nbsp;</span> sur
            <span class="font-semibold text-white">{{ tasksStore.totalContacts }}&nbsp;</span> éléments
        </div>
        <div class="flex items-center space-x-3">
            <button @click="prevPage" :disabled="!tasksStore.prevPageUrl"
                class="p-2 rounded-lg border border-gray-600 bg-gray-800 hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                <img src="/images/icon/left.png" alt="Previous Page" class="w-4 h-4" />
            </button>
            <span class="px-4 py-1 rounded-lg bg-gray-800 text-white font-semibold">
                {{ tasksStore.currentPage }}
            </span>
            <button @click="nextPage" :disabled="!tasksStore.nextPageUrl"
                class="p-2 rounded-lg border border-gray-600 bg-gray-800 hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                <img src="/images/icon/left-4.png" alt="Next Page" class="w-4 h-4" />
            </button>
        </div>
    </div>

    <!-- Edit Task Modal -->
    <EditTaskModal v-if="isEditModalOpen"
        :isOpen="isEditModalOpen"
        :taskData="selectedTask"
        :users="users"
        @close="isEditModalOpen = false"
        @save="updateTask"
    />
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useTasksStore } from "../store/task";
import NavigationTabs from "../components/NavigationTabs.vue";
import EditTaskModal from "../components/Task/EditTaskModal.vue";
import Filter from "../components/Filter.vue";

const tasksStore = useTasksStore();
const selectedTask = ref(null);
const isEditModalOpen = ref(false);
const selectedTasks = ref([]);

const handleDeleteTask = async (id) => {
    if (confirm("Are you sure you want to delete this contact?")) {
        await contactsStore.removeTask(id);
        await contactsStore.getTasks();
        alert("Delete success");
    }
};

const prevPage = () => tasksStore.getTasks(tasksStore.currentPage - 1);
const nextPage = () => tasksStore.getTasks(tasksStore.currentPage + 1);

const handleEditTask = (task) => {
    selectedTask.value = { ...task };
    isEditModalOpen.value = true;
};

const updateTask = (updatedTask) => {
    isEditModalOpen.value = false;
};

onMounted(() => {
    tasksStore.getTasks();
});
</script>
