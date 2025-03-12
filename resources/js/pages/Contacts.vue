<template>
    <NavigationTabs />
    <div class="flex justify-between items-center pb-4 mt-7">
        <div class="flex items-center gap-3">
            <button class="bg-orange-600 hover:bg-orange-500 text-white py-2 px-4 rounded flex items-center gap-2"
                @click="isModalOpen = true">
                <img src="/images/icon/plus.png" alt="Add Contact" class="left-2.5 top-2.5 w-4 h-4 text-white" />
                <p class="text-xs">Ajout de contact</p>
            </button>
            <p class="text-white text-sm font-semibold">
                {{ contactsStore.totalContacts }} <span class="text-gray-400 font-normal">Contacts</span>
            </p>
        </div>
        <Filter />
    </div>

    <div class="bg-[#17202E] p-6 rounded-lg shadow-lg mt-5">
        <!-- Loading -->
        <div v-if="contactsStore.loading" class="flex justify-center py-10">
            <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path fill="currentColor" d="M4 12a8 8 0 018-8v8h8"></path>
            </svg>
        </div>

        <!-- Contact List -->
        <table v-else class="min-w-full divide-y divide-gray-700 text-sm">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Nom du contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Téléphone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Opportunity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Manager</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Responsable</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 tracking-wider">Étiquettes</th>
                    <th class="px-6 py-3 text-xs font-medium text-gray-400 tracking-wider text-center">
                        <img src="/images/icon/setting.png" alt="Settings" class="w-4 h-4 text-white" />
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
                <tr v-for="contact in contactsStore.contacts" :key="contact.id" class="hover:bg-gray-800">
                    <td class="px-6 py-4 whitespace-nowrap text-white">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" class="w-4 h-4 text-red-600 border-gray-300 rounded-lg" />
                            <div>
                                <div class="text-white">{{ contact.name }}</div>
                                <div class="text-gray-400 text-xs">Particulier</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ contact.email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ contact.phone }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                        <span v-if="contact.opportunities.length > 0">
                            {{ contact.opportunities[0].title }}
                        </span>
                        <span v-else class="text-gray-500">-</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                        <span v-if="contact.opportunities.length > 0">
                            {{ contact.opportunities[0].user_id }}
                        </span>
                        <span v-else class="text-gray-500">-</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ contact.user?.name || '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <span v-for="tag in contact.tags" :key="tag.id"
                                class="inline-flex items-center text-white px-2 text-xs font-medium rounded-lg bg-red-500">
                                {{ tag.name }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-400">
                        <button class="mr-3 hover:text-white">
                            <img src="/images/icon/edit.png" alt="Edit" class="w-4 h-4 text-white" />
                        </button>
                        <button class="hover:text-red-600" @click="handleDeleteContact(contact.id)">
                            <img src="/images/icon/trash.png" alt="Delete" class="w-4 h-4 text-white" />
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
                contactsStore.perPage }} <img class="h-3" src="/images/icon/arrow-down.png" alt="">
            </div>
            <span class="font-semibold text-white">{{ contactsStore.from }}-{{ contactsStore.to }}&nbsp;</span> sur
            <span class="font-semibold text-white">{{ contactsStore.totalContacts }}&nbsp;</span> éléments
        </div>
        <div class="flex items-center space-x-3">
            <button @click="prevPage" :disabled="!contactsStore.prevPageUrl"
                class="p-2 rounded-lg border border-gray-600 bg-gray-800 hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                <img src="/images/icon/left.png" alt="Previous Page" class="w-4 h-4" />
            </button>
            <span class="px-4 py-1 rounded-lg bg-gray-800 text-white font-semibold">
                {{ contactsStore.currentPage }}
            </span>
            <button @click="nextPage" :disabled="!contactsStore.nextPageUrl"
                class="p-2 rounded-lg border border-gray-600 bg-gray-800 hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                <img src="/images/icon/left-4.png" alt="Next Page" class="w-4 h-4" />
            </button>
        </div>
    </div>


    <!-- Modal -->
    <Modal :isOpen="isModalOpen" @close="isModalOpen = false">
        <ContactForm @success="handleAddContact" @close="isModalOpen = false" />
    </Modal>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Filter from "../components/Filter.vue";
import NavigationTabs from "../components/NavigationTabs.vue";
import ContactForm from "../components/Contact/ContactForm.vue";
import { useContactsStore } from "../store/contacts";

const contactsStore = useContactsStore();
const isModalOpen = ref(false);

// Xóa contact
const handleDeleteContact = async (id) => {
    if (confirm("Are you sure you want to delete this contact?")) {
        await contactsStore.removeContact(id);
        await contactsStore.getContacts();
        alert("Delete success");
    }
};

// Phân trang
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
