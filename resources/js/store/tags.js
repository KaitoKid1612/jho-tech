import { defineStore } from "pinia";
import api from "../utils/api";

export const useTagsStore = defineStore("tags", {
  state: () => ({
    tags: [],
  }),
  actions: {
    async fetchTags() {
      const response = await api.get("/tags");
      this.tags = response.data;
    },
  },
});
