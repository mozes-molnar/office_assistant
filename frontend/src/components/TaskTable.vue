<script>
import axios from "axios";
import { ref } from "vue";
import CreateTaskModal from "./CreateTaskModal.vue";

export default {
  components: {
    CreateTaskModal,
  },
  setup() {
    const tasks = ref([]);
    const isEditModalVisible = ref(false);
    const selectedTask = ref(null);

    const fetchTasks = async () => {
      try {
        const response = await axios.get(
          `${import.meta.env.VITE_API_URL}/tasks`
        );
        if (response.data) {
          tasks.value = response.data;
        }
      } catch (error) {
        console.error("Hiba történt a feladatok betöltésekor:", error);
      }
    };

    const editTask = async (task) => {
    };

    const deleteTask = async (task) => {
      const confirmation = confirm(
        "Biztosan törölni szeretné ezt a feladatot?"
      );
      if (confirmation) {
        try {
          await axios.delete(
            `${import.meta.env.VITE_API_URL}/tasks/${task.id}`
          );
          tasks.value = tasks.value.filter((t) => t.id !== task.id);
        } catch (error) {
          console.error("Hiba történt a feladat törlésekor:", error);
        }
      }
    };

    fetchTasks();

    return {
      tasks,
      isEditModalVisible,
      selectedTask,
      fetchTasks,
      editTask,
      deleteTask,
    };
  },
};
</script>

<template>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Ügyintéző neve</th>
        <th>Leírás</th>
        <th>Műveletek</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(task, index) in tasks" :key="index">
        <td>{{ task.office_clerk_id }}</td>
        <td>{{ task.description }}</td>
        <td>
          <a class="btn btn-warning" @click="editTask(task)">Szerkesztés</a>
          <a class="btn btn-danger ms-2" @click="deleteTask(task)">Törlés</a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<style scoped>
</style>
