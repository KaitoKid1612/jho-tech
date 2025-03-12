import { defineStore } from "pinia";
import api from "../utils/api";

export const useTasksStore = defineStore("tasks", {
  state: () => ({
    tasks: [],
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
    async getTasks(page = 1) {
      this.loading = true;
      try {
        const response = await api.get(`/tasks?page=${page}`);
        const data = response.data;

        this.tasks = data.data;
        this.total = data.total;
        this.currentPage = data.current_page;
        this.perPage = data.per_page;
        this.from = data.from;
        this.to = data.to;
        this.prevPageUrl = data.prev_page_url;
        this.nextPageUrl = data.next_page_url;
      } catch (error) {
        console.error("Lỗi khi tải danh sách tâches:", error);
      } finally {
        this.loading = false;
      }
    },

    async toggleTaskCompletion(taskId) {
      try {
        const task = this.tasks.find(t => t.id === taskId);
        if (task) {
          task.completed = !task.completed;
          await api.put(`/tasks/${taskId}`, { completed: task.completed });
        }
      } catch (error) {
        console.error("Lỗi khi cập nhật trạng thái tâche:", error);
      }
      },

    async removeTask(id) {
            await api.delete(`/tasks/${id}`);
        },
  }
});
