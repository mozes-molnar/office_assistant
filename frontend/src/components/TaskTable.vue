<script setup>
import axios from "axios";

let tasks = [];

const fetchTasks = async () => {
  try {
    // HIBA: Az axios.get() metódusnak egy URL-t kell átadni, de zárójelekben van a URL, ami helytelen
    const response = await axios.get(import.meta.env.VITE_API_URL + "/tasks");
    tasks = response.data;
  } catch (error) {
    console.error("Hiba történt a feladatok lekérése közben:", error);
  }
};

fetchTasks();
</script>

<template>
  <div>
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
            <a class="btn btn-warning">Szerkesztés</a>
            <a class="btn btn-danger ms-2">Törlés</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped></style>