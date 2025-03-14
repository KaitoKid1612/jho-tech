<template>
  <nav class="bg-transparent divide-y">
    <div class="flex space-x-8 border-b border-[#273140]">
      <button
        v-for="tab in tabs"
        :key="tab.id"
        @click="changeTab(tab.id)"
        class="group relative flex items-center gap-1 px-5 py-4 text-xs"
        :class="{
          'text-white bg-[#DD531333]': activeTab === tab.id,
          'text-gray-400 hover:text-white': activeTab !== tab.id
        }"
      >
        <img :src="tab.icon" alt="" class="h-4.5 w-4.5" />
        <span>{{ tab.label }}</span>
        <div v-if="activeTab === tab.id" class="absolute bottom-0 left-0 h-1 w-full bg-[#f85149]"></div>
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
  { id: "contacts", label: "Contacts", icon: "/images/icon/contacts 4.svg" },
  { id: "equestres", label: "Equestres", icon: "/images/icon/Tag 1.svg" },
  { id: "opportunites", label: "Opportunités", icon: "/images/icon/euro square.svg" },
  { id: "taches", label: "Tâches", icon: "/images/icon/Board tasks.svg" }
]);

const changeTab = (tabId) => {
  activeTab.value = tabId;
  router.push(`/${tabId}`);
};

watchEffect(() => {
  activeTab.value = route.path.replace("/", "") || "contacts";
});
</script>
