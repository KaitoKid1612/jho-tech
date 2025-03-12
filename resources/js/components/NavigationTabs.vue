<template>
  <nav class="bg-transparent divide-y">
    <div class="flex space-x-8">
      <button
        v-for="tab in tabs"
        :key="tab.id"
        @click="changeTab(tab.id)"
        class="group relative flex items-center gap-2 px-5 py-4 text-sm font-medium outline-none rounded-md"
        :class="{
          'text-white bg-[#DD531333]': activeTab === tab.id,
          'text-gray-400 hover:text-white': activeTab !== tab.id
        }"
      >
        <img :src="tab.icon" alt="" class="h-4 w-4" />
        <span>{{ tab.label }}</span>
        <div v-if="activeTab === tab.id" class="absolute bottom-0 left-0 h-0.5 w-full bg-[#f85149]"></div>
      </button>
    </div>
  </nav>
</template>

<script setup>
import { ref, watchEffect } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const activeTab = ref(route.path.replace("/", "") || "contacts");

const tabs = ref([
  { id: "contacts", label: "Contacts", icon: "/images/icon/contact.png" },
  { id: "equestres", label: "Equestres", icon: "/images/icon/tag.png" },
  { id: "opportunites", label: "Opportunités", icon: "/images/icon/euro.png" },
  { id: "taches", label: "Tâches", icon: "/images/icon/tasks.png" }
]);

const changeTab = (tabId) => {
  activeTab.value = tabId;
  router.push(`/${tabId}`);
};

watchEffect(() => {
  activeTab.value = route.path.replace("/", "") || "contacts";
});
</script>
