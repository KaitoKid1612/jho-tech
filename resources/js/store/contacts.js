import { defineStore } from "pinia";
import api from "../utils/api";

export const useContactsStore = defineStore("contacts", {
    state: () => ({
        contacts: [],
        loading: false,
        totalContacts: 0,
        currentPage: 1,
        perPage: 25,
        from: 0,
        to: 0,
        prevPageUrl: null,
        nextPageUrl: null,
    }),
    actions: {
        async getContacts(url = "/contacts") {
            this.loading = true;
            try {
                const response = await api.get(url);
                this.contacts = response.data.data;
                this.totalContacts = response.data.total;
                this.currentPage = response.data.current_page;
                this.perPage = response.data.per_page;
                this.from = response.data.from;
                this.to = response.data.to;
                this.prevPageUrl = response.data.prev_page_url;
                this.nextPageUrl = response.data.next_page_url;
            } finally {
                this.loading = false;
            }
        },
        async removeContact(id) {
            await api.delete(`/contacts/${id}`);
        },
    },
});
