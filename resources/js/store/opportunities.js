import { defineStore } from "pinia";
import api from "../utils/api";

export const useOpportunitiesStore = defineStore("opportunities", {
  state: () => ({
    opportunities: [],
    total: 0,
    currentPage: 1,
    perPage: 25,
    from: 0,
    to: 0,
    prevPageUrl: null,
    nextPageUrl: null,
    loading: false,
  }),

  actions: {
    async getOpportunities(page = 1) {
      this.loading = true;
      try {
        const response = await api.get(`/opportunities?page=${page}`);
        const data = response.data;

        this.opportunities = data.data;
        this.total = data.total;
        this.currentPage = data.current_page;
        this.perPage = data.per_page;
        this.from = data.from;
        this.to = data.to;
        this.prevPageUrl = data.prev_page_url;
        this.nextPageUrl = data.next_page_url;
      } catch (error) {
        console.error("Lỗi khi tải cơ hội:", error);
      } finally {
        this.loading = false;
      }
    }
  }
});
