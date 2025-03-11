<template>
  <aside class="flex min-h-screen w-[60px] flex-col bg-[#17202E] py-4">
    <!-- Logo -->
    <div class="mb-8 flex justify-center">
      <img src="/images/logo-small.png" alt="Logo" class="h-6 w-6" />
    </div>

    <!-- Navigation -->
    <nav class="flex flex-1 flex-col items-center gap-4">
      <button v-for="(item, index) in navItems" :key="index" class="group relative p-2">
        <img
          :src="item.icon"
          :alt="item.label"
          class="h-5 w-5 text-gray-400 transition-colors group-hover:text-white"
        />
      </button>
    </nav>

    <!-- Bottom Section -->
    <div class="mt-auto flex justify-center">
      <button class="group relative p-2" @click="handleLogout">
        <img
          src="/images/icon/logout.png"
          alt="Logout"
          class="h-5 w-5 text-gray-400 transition-colors group-hover:text-white"
        />
      </button>
    </div>
  </aside>
</template>

<script setup>
import { useRouter } from "vue-router";
import { useAuthStore } from "../store/index";

const router = useRouter();
const authStore = useAuthStore();

const handleLogout = () => {
  authStore.logout();
  router.push("/login");
};

const navItems = [
  { label: "Home", icon: "/images/icon/paper.png" },
  { label: "Explore", icon: "/images/icon/users.png" },
  { label: "Messages", icon: "/images/icon/box.png" },
  { label: "Notifications", icon: "/images/icon/three-user.png" },
  { label: "Bookmarks", icon: "/images/icon/study.png" },
  { label: "Lists", icon: "/images/icon/note.png" },
  { label: "Profile", icon: "/images/icon/start.png" },
  { label: "More", icon: "/images/icon/share.png" },
  { label: "More", icon: "/images/icon/card.png" },
  { label: "More", icon: "/images/icon/filter.svg" },
  { label: "More", icon: "/images/icon/connect.png" },
];
</script>
