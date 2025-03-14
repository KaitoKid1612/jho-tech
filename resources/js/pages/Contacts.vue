<template>
    <NavigationTabs />
    <div class="flex justify-between items-center mt-7">
        <div class="flex items-center gap-3">
            <button class="bg-orange-600 hover:bg-orange-500 text-white py-3 px-11 rounded-xl flex items-center gap-1"
                @click="isModalOpen = true">
                <img src="/images/icon/plus.png" alt="Add Contact" class="w-4.5 h-4.5 text-white" />
                <p class="text-xs">Ajout de contact</p>
            </button>
            <p class="text-white text-sm font-semibold">
                {{ contactsStore.totalContacts }} <span class="text-white font-normal">Contacts</span>
            </p>
        </div>
        <Filter />
    </div>

    <div class="bg-[#17202E] px-8 py-7 rounded-lg shadow-lg mt-12">
        <!-- Loading -->
        <div v-if="contactsStore.loading" class="flex justify-center py-10">
            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path fill="currentColor" d="M4 12a8 8 0 018-8v8h8"></path>
            </svg>
        </div>

        <!-- Contact List -->
        <table class="min-w-full">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="px-8 py-3 text-left text-xs text-gray-400 tracking-wider">
                        <input type="checkbox" v-model="selectAll" @change="toggleSelectAll" class="hidden peer" />

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="white" class="w-5 h-5 cursor-pointer peer-checked:hidden" @click="toggleSelectAll">
                            <rect x="3" y="3" width="18" height="18" rx="4" stroke="white"></rect>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                            class="w-5 h-5 cursor-pointer hidden peer-checked:block text-orange-500"
                            @click="toggleSelectAll">
                            <rect x="3" y="3" width="18" height="18" rx="4" fill="currentColor"></rect>
                            <path stroke="white" stroke-width="2" d="M7 12l3 3 7-7"></path>
                        </svg>
                    </th>
                    <th
                        class="pr-[52px] py-3 text-left text-xs text-gray-400 font-normal tracking-wider border-r border-gray-700">
                        Nom du contact
                    </th>
                    <th
                        class="px-[52px] py-3 text-left text-xs text-gray-400 font-normal tracking-wider border-r border-gray-700">
                        Email
                    </th>
                    <th
                        class="px-[52px] py-3 text-left text-xs text-gray-400 font-normal tracking-wider border-r border-gray-700">
                        Téléphone
                    </th>
                    <th
                        class="px-[52px] py-3 text-left text-xs text-gray-400 font-normal tracking-wider border-r border-gray-700">
                        Opportunity
                    </th>
                    <th
                        class="px-[52px] py-3 text-left text-xs text-gray-400 font-normal tracking-wider border-r border-gray-700">
                        Responsable
                    </th>
                    <th
                        class="pr-[32px] pl-[25px] py-3 text-left text-xs text-gray-400 font-normal tracking-wider border-r border-gray-700 last:border-r-0">
                        Étiquettes
                    </th>
                    <th class="pr-[27px] pl-[37px] py-3 text-xs font-medium text-gray-400 tracking-wider text-center">
                        <img src="/images/icon/setting.png" alt="Settings" class="w-4 h-4" />
                    </th>
                </tr>
            </thead>
            <tbody class="text-xs leading-[16px]">
                <tr v-for="contact in contactsStore.contacts" :key="contact.id"
                    class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="px-8 py-4 text-white">
                        <input type="checkbox" v-model="selectedContacts" :value="contact.id" class="hidden peer" />

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="white" class="w-5 h-5 cursor-pointer peer-checked:hidden"
                            @click="toggleCheckbox(contact.id)">
                            <rect x="3" y="3" width="18" height="18" rx="4" stroke="white"></rect>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                            class="w-5 h-5 cursor-pointer hidden peer-checked:block text-orange-500"
                            @click="toggleCheckbox(contact.id)">
                            <rect x="3" y="3" width="18" height="18" rx="4" fill="currentColor"></rect>
                            <path stroke="white" stroke-width="2" d="M7 12l3 3 7-7"></path>
                        </svg>
                    </td>

                    <td class="pr-[52px] py-4 text-white border-r border-gray-700">
                        <div class="text-white font-bold">{{ contact.name }}</div>
                        <div class="text-gray-400 text-xs">Particulier</div>
                    </td>
                    <td class="px-[52px] py-4 text-gray-300 border-r border-gray-700">
                        <div class="flex items-center gap-2">
                            <img src="/images/icon/message.png" alt="Email" class="w-4 h-4 max-w-none" />
                            <span>{{ contact.email }}</span>
                        </div>
                    </td>
                    <td class="px-[52px] py-4 text-gray-300 border-r border-gray-700">
                        <div class="flex items-center gap-2">
                            <img src="/images/icon/call.png" alt="Phone" class="w-4 h-4 max-w-none" />
                            <span>{{ contact.phone }}</span>
                        </div>
                    </td>
                    <td class="px-[52px] py-4 text-gray-300 border-r border-gray-700">
                        <span v-if="contact.opportunities.length > 0">
                            {{ contact.opportunities[0].title }}
                        </span>
                    </td>
                    <td class="px-[52px] py-4 text-gray-300 border-r border-gray-700">
                        <div class="flex items-center gap-1">
                            <img src="/images/icon/avatar.png" alt="Phone" class="w-4 h-4 max-w-none" />
                            {{ contact.user?.name }}
                        </div>
                    </td>
                    <td class="pr-[32px] pl-[25px] py-4 text-gray-300 border-r border-gray-700 last:border-r-0">
                        <div class="space-x-2 items-center">
                            <span v-for="tag in contact.tags" :key="tag.id"
                                class="inline-flex items-center text-white px-2 text-xs font-medium rounded-lg bg-red-500">
                                {{ tag.name }}
                            </span>
                        </div>
                    </td>
                    <td class="flex gap-1 px-6 py-4 text-center text-gray-400">
                        <button class="hover:text-white">
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

    <!-- Pagination -->
    <div class="flex pt-4 text-gray-400 text-xs relative">
        <div class="flex items-center space-x-3 pl-[138px]">
            <span>Éléments par page:</span>
            <div class="p-2 flex gap-1 justify-center items-center border border-[#273140] rounded-lg">{{
                contactsStore.perPage }} <img class="h-3" src="/images/icon/arrow-down.png" alt="">
            </div>
            <span class="ml-4">{{ contactsStore.from }}-{{ contactsStore.to }}</span>
            <span>sur</span>
            <span>{{ contactsStore.totalContacts }}</span>
            <span>éléments</span>
        </div>
        <div class="flex items-center space-x-3 absolute left-1/2">
            <button @click="prevPage" :disabled="!contactsStore.prevPageUrl"
                class="disabled:opacity-50 disabled:cursor-not-allowed">
                <img src="/images/icon/Left 1.svg" alt="Previous Page" class="w-4 h-4" />
            </button>
            <button @click="prevPage" :disabled="!contactsStore.prevPageUrl">
                <img src="/images/icon/Left 3.svg" alt="Previous Page" class="w-4 h-4" />
            </button>
            <span class="px-4 py-1 rounded-lg bg-gray-800 text-white font-semibold">
                {{ contactsStore.currentPage }}
            </span>
            <button @click="nextPage" :disabled="!contactsStore.nextPageUrl">
                <img src="/images/icon/Left 5.svg" alt="Next Page" class="w-4 h-4" />
            </button>
            <button @click="nextPage" :disabled="!contactsStore.nextPageUrl"
                class="disabled:opacity-50 disabled:cursor-not-allowed">
                <img src="/images/icon/Left 4.svg" alt="Next Page" class="w-4 h-4" />
            </button>
        </div>
    </div>


    <!-- Modal -->
    <Modal :isOpen="isModalOpen" @close="isModalOpen = false">
        <ContactForm @success="handleAddContact" @close="isModalOpen = false" />
    </Modal>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import Filter from "../components/Filter.vue";
import NavigationTabs from "../components/NavigationTabs.vue";
import ContactForm from "../components/Contact/ContactForm.vue";
import { useContactsStore } from "../store/contacts";

const contactsStore = useContactsStore();
const isModalOpen = ref(false);
const selectedContacts = ref([]);


const toggleCheckbox = (contactId) => {
    if (selectedContacts.value.includes(contactId)) {
        selectedContacts.value = selectedContacts.value.filter(id => id !== contactId);
    } else {
        selectedContacts.value.push(contactId);
    }
};

const selectAll = computed({
    get: () => selectedContacts.value.length === contactsStore.contacts.length,
    set: (value) => {
        if (value) {
            selectedContacts.value = contactsStore.contacts.map(contact => contact.id);
        } else {
            selectedContacts.value = [];
        }
    }
});

const toggleSelectAll = () => {
    selectAll.value = !selectAll.value;
};

const handleDeleteContact = async (id) => {
    if (confirm("Are you sure you want to delete this contact?")) {
        await contactsStore.removeContact(id);
        await contactsStore.getContacts();
        alert("Delete success");
    }
};

const prevPage = () => {
    if (contactsStore.prevPageUrl) {
        contactsStore.getContacts(contactsStore.prevPageUrl);
    }
};

const nextPage = () => {
    if (contactsStore.nextPageUrl) {
        contactsStore.getContacts(contactsStore.nextPageUrl);
    }
};

onMounted(() => {
    contactsStore.getContacts();
});
</script>
