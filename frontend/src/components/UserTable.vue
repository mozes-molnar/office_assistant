<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const emit = defineEmits(["create-task", "edit-user"]);
const users = ref([]);

const fetchUsers = async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_API_URL}/office_clerk`
    );
    console.log(response);
    users.value = response.data;
  } catch (err) {
    console.error("Hiba történt az ügyintézők betöltésekor:", err);
  }
};

const createNewTask = (user) => {
  emit("create-task", user);
};

const editUser = async (user) => {
  emit("edit-user", user);
};

const deleteUser = async (user) => {
  const confirmation = confirm("Biztosan törölni szeretné ezt az ügyintézőt?");
  if (confirmation) {
    try {
      await axios.delete(
        `${import.meta.env.VITE_API_URL}/office_clerk/${user.id}`
      );
      users.value = users.value.filter((u) => u.id !== user.id);
    } catch (error) {
      console.error("Hiba történt az ügyintéző törlésekor:", error);
    }
  }
};

onMounted(fetchUsers);

defineExpose({
  fetchUsers,
});
</script>

<template>
  <div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th style="width: 20%">Ügyintéző neve</th>
          <th style="width: 10%">Ügyintéző email</th>
          <th style="width: 15%">Létrehozás dátuma</th>
          <th style="width: 25%">Leírás</th>
          <th style="width: 30%">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in users" :key="index">
          <td>{{ user.name }}</td>
          <td>
            <a :href="'mailto:' + user.email">{{ user.email }}</a>
          </td>
          <td>{{ user.created_at }}</td>
          <td>{{ user.description }}</td>
          <td>
            <a class="btn btn-info" @click="createNewTask(user)">Új feladat</a>
            <a class="btn btn-warning ms-2" @click="editUser(user)"
              >Szerkesztés</a
            >
            <a class="btn btn-danger ms-2" @click="deleteUser(user)">Törlés</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
