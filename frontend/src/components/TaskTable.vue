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
    const officeClerks = ref([]);
    const isEditModalVisible = ref(false);
    const selectedTask = ref(null);

    const fetchTasksAndOfficeClerks = async () => {
      try {
        const tasksResponse = await axios.get(
          `${import.meta.env.VITE_API_URL}/tasks`
        );
        const officeClerksResponse = await axios.get(
          `${import.meta.env.VITE_API_URL}/office_clerk`
        );

        if (tasksResponse.data) {
          tasks.value = tasksResponse.data;
        }

        if (officeClerksResponse.data) {
          officeClerks.value = officeClerksResponse.data;
        }
      } catch (error) {
        console.error(
          "Hiba történt a feladatok vagy az irodai dolgozók betöltésekor:",
          error
        );
      }
    };

    const editTask = async (task) => {};

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

    const getOfficeClerkName = (officeClerkId) => {
      const officeClerk = officeClerks.value.find(
        (clerk) => clerk.id === officeClerkId
      );
      return officeClerk ? officeClerk.name : "Nem elérhető";
    };

    fetchTasksAndOfficeClerks();

    return {
      tasks,
      isEditModalVisible,
      selectedTask,
      fetchTasksAndOfficeClerks,
      editTask,
      deleteTask,
      getOfficeClerkName,
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
        <td>{{ getOfficeClerkName(task.office_clerk_id) }}</td>
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
