import { defineStore } from "pinia";
import api from "../utils/api";

export const useContactsStore = defineStore("contacts", {
  state: () => ({
    contacts: [],
    loading: false,
  }),
  actions: {
    async getContacts() {
      this.loading = true;
      try {
        const response = await api.get("/contacts");
        this.contacts = response.data;
      } finally {
        this.loading = false;
      }
    },
    async removeContact(id) {
      await api.delete(`/contacts/${id}`);
      },
    async addContact(data) {
      await api.post("/contacts", data);
    },
  },
});
