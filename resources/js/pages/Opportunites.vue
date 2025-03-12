<template>
    <NavigationTabs />
    <div class="flex justify-between items-center pb-4 mt-7">
        <div class="flex items-center gap-3">
            <button class="bg-orange-600 hover:bg-orange-500 text-white py-3 px-10 rounded-xl flex items-center gap-2"
                @click="isModalOpen = true">
                <img src="/images/icon/plus.png" alt="Add Opportunity" class="left-2.5 top-2.5 w-4 h-4 text-white" />
                <p class="text-xs">Ajout opportunité</p>
            </button>
            <div class="flex items-center text-white">
                <div class="px-3 py-3 bg-[#273140] border border-[#273140] rounded-lg">
                    <img src="/images/icon/bull-list.png" alt="List View" class="w-[18px] h-[18px]" />
                </div>
                <div class="px-3 py-3 border border-[#273140] rounded-lg">
                    <img src="/images/icon/align-top.png" alt="Sort" class="w-[18px] h-[18px]" />
                </div>
            </div>
            <div class="flex items-center gap-1 text-white px-3 py-3 border border-[#16FCD2] rounded-lg">
                <span class="text-[10px]">Pipeline</span>
                <img src="/images/icon/arrow-down.png" alt="Filter" class="w-3 h-3 text-white" />
            </div>
            <p class="text-white text-sm font-semibold">
                {{ opportunitiesStore.total }} <span class="text-gray-400 font-normal">Opportunités</span>
            </p>
        </div>
        <Filter />
    </div>

    <div class="bg-[#17202E] p-6 rounded-lg shadow-lg mt-5">
        <!-- Loading -->
        <div v-if="opportunitiesStore.loading" class="flex justify-center py-10">
            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path fill="currentColor" d="M4 12a8 8 0 018-8v8h8"></path>
            </svg>
        </div>

        <!-- Opportunities List -->
        <table v-else class="min-w-full divide-y divide-gray-700 text-sm">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">
                        <input type="checkbox" v-model="selectAll" @change="toggleSelectAll"
                            class="w-4 h-4 text-red-600 border-gray-300 rounded-lg" />
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Nom de la
                        transaction</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Phase</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Étiquette</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Organisation</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Responsable</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Valeur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Date closing</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-400 tracking-wider text-center">
                        <img src="/images/icon/setting.png" alt="Settings" class="w-4 h-4 text-white max-w-none" />
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 text-xs leading-[16px]">
                <tr v-for="opportunity in opportunitiesStore.opportunities" :key="opportunity.id"
                    class="hover:bg-gray-800">
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        <input type="checkbox" v-model="selectedOpportunities" :value="opportunity.id"
                            class="w-4 h-4 text-red-600 border-gray-300 rounded-lg" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-white">{{ opportunity.title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ opportunity.status }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                        <div class="flex space-x-2">
                            <span v-for="tag in opportunity.tags" :key="tag.id"
                                class="px-2 text-xs font-medium rounded-lg bg-red-500 text-white">
                                {{ tag.name }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ opportunity.organization?.name || '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ opportunity.contact?.name || '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                        <div class="flex items-center gap-2">
                            <img src="/images/icon/avatar.png" alt="Phone" class="w-4 h-4 text-white max-w-none" />
                            {{ opportunity.user?.name || '-' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ opportunity.amount ? `${opportunity.amount}
                        €` : '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ opportunity.closing_date || '-' }}</td>
                    <td class="flex gap-1 px-6 py-4 whitespace-nowrap text-center text-gray-400">
                        <button class="hover:text-white">
                            <img src="/images/icon/edit.png" alt="Edit" class="w-4 h-4 text-white max-w-none" />
                        </button>
                        <button class="hover:text-red-600" @click="handleDeleteContact(contact.id)">
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
            Éléments par page:&nbsp;
            <div class="p-2 flex gap-1 justify-center items-center border border-[#273140] rounded-lg">
                {{ opportunitiesStore.perPage }}
                <img class="h-3" src="/images/icon/arrow-down.png" alt="">
            </div>
            <span class="font-semibold text-white">{{ opportunitiesStore.from }}-{{ opportunitiesStore.to
                }}&nbsp;</span> sur
            <span class="font-semibold text-white">{{ opportunitiesStore.total }}&nbsp;</span> éléments
        </div>
        <div class="flex items-center space-x-3">
            <button @click="prevPage" :disabled="!opportunitiesStore.prevPageUrl"
                class="p-2 rounded-lg border border-gray-600 bg-gray-800 hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                <img src="/images/icon/left.png" alt="Previous Page" class="w-4 h-4" />
            </button>
            <span class="px-4 py-1 rounded-lg bg-gray-800 text-white font-semibold">
                {{ opportunitiesStore.currentPage }}
            </span>
            <button @click="nextPage" :disabled="!opportunitiesStore.nextPageUrl"
                class="p-2 rounded-lg border border-gray-600 bg-gray-800 hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                <img src="/images/icon/left-4.png" alt="Next Page" class="w-4 h-4" />
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useOpportunitiesStore } from "../store/opportunities";
import NavigationTabs from "../components/NavigationTabs.vue";
import Filter from "../components/Filter.vue";

const opportunitiesStore = useOpportunitiesStore();
const selectedOpportunities = ref([]);

const prevPage = () => opportunitiesStore.getOpportunities(opportunitiesStore.currentPage - 1);
const nextPage = () => opportunitiesStore.getOpportunities(opportunitiesStore.currentPage + 1);

onMounted(() => {
    opportunitiesStore.getOpportunities();
});
</script>
