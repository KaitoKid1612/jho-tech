import { defineStore } from "pinia";
import api from "../utils/api";

export const useManagersStore = defineStore("managers", {
  state: () => ({
    managers: [],
  }),
  actions: {
    async fetchManagers() {
      const response = await api.get("/managers");
      this.managers = response.data;
    },
  },
});
