<template>
    <div class="flex justify-between items-center pb-4">
      <div class="flex items-center gap-3" @click="isModalOpen = true">
        <button class="bg-orange-600 hover:bg-orange-500 text-white py-2 px-4 rounded flex items-center gap-2">
          <img src="/images/icon/plus.png" alt="Add Contact" class="left-2.5 top-2.5 w-4 h-4 text-white" />
          <p class="text-xs">Ajout de contact</p>
        </button>
        <p class="text-white text-sm font-semibold">
          100 <span class="text-gray-400 font-normal">Contacts</span>
        </p>
      </div>
      <Filter />
    </div>
    <NavigationTabs />

    <div class="bg-[#17202E] p-6 rounded-lg shadow-lg mt-5">
      <!-- Loading -->
      <div v-if="loading" class="flex justify-center py-10">
        <svg class="animate-spin h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path fill="currentColor" d="M4 12a8 8 0 018-8v8h8"></path>
        </svg>
      </div>

      <!-- Contact List -->
      <table v-else class="min-w-full divide-y divide-gray-700 text-sm">
        <thead>
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nom du contact</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Email</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Téléphone</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Creater</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Manager</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Étiquettes</th>
            <th class="px-6 py-3 text-xs font-medium text-gray-400 uppercase tracking-wider text-center">
              <img src="/images/icon/setting.png" alt="Settings" class="w-4 h-4 text-white" />
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
          <tr v-for="contact in contacts" :key="contact.id" class="hover:bg-gray-800">
            <td class="flex items-center">
              <input type="checkbox" class="w-4 h-4 text-red-600 border-gray-300 rounded-lg" />
              <div class="px-6 py-4 whitespace-nowrap">
                <div class="text-white">{{ contact.name }}</div>
                <div class="text-gray-400 text-xs">Particulier</div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ contact.email }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ contact.phone }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ contact.creator.name }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ contact.manager.name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex space-x-2">
                <span v-for="tag in contact.tags" :key="tag.id" class="inline-flex items-center text-white px-1 text-xs font-medium rounded-lg bg-red-500">
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
    <div class="flex justify-between items-center pt-4 text-gray-400">
      <span>Éléments par page: 25 | 1-25 sur 500 éléments</span>
      <div class="flex space-x-2">
        <button class="hover:text-white">◀</button>
        <span class="text-white">01</span>
        <button class="hover:text-white">▶</button>
      </div>
    </div>

    <!-- Modal -->
    <Modal :isOpen="isModalOpen" @close="isModalOpen = false">
      <h2 class="text-white text-lg mb-4">Add New Contact</h2>
      <ContactForm @success="handleAddContact" @close="isModalOpen = false" />
    </Modal>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Filter from "../components/Filter.vue";
import NavigationTabs from "../components/NavigationTabs.vue";
import Modal from "../components/Modal.vue";
import ContactForm from "../components/Contact/ContactForm.vue";
import { useContactsStore } from "../store/contacts";

const contactsStore = useContactsStore();
const { contacts, loading, getContacts, removeContact } = contactsStore;

const isModalOpen = ref(false);


// Hàm gọi lại để lấy danh sách sau khi thêm mới
const handleAddContact = async () => {
  isModalOpen.value = false;
  await getContacts();
};

// Hàm xử lý xóa liên hệ
const handleDeleteContact = async (id) => {
  if (confirm("Are you sure you want to delete this contact?")) {
    await removeContact(id);
    await getContacts();
    alert("Delete success");
  }
};

onMounted(() => {
    console.log("HomeLayout â!");
    getContacts();
});
</script>
