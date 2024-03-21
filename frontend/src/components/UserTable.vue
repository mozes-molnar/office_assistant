<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import CreateUserModal from "./CreateUserModal.vue";

const emit = defineEmits(["create-task"]);
const users = ref([]);
const isEditModalVisible = ref(false);
const selectedUser = ref(null);

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
  selectedUser.value = user;
  isEditModalVisible.value = true;
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
</script>

<template>
  <CreateUserModal v-if="isEditModalVisible" :selected-user="selectedUser" />
  <div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Ügyintéző neve</th>
          <th>Ügyintéző email</th>
          <th>Létrehozás dátuma</th>
          <th>Leírás</th>
          <th>Actions</th>
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
            <a class="btn btn-warning" @click="createNewTask(user)"
              >Új feladat</a
            >
            <a class="btn btn-warning" @click="editUser(user)">Szerkesztés</a>
            <a class="btn btn-danger ms-2" @click="deleteUser(user)">Törlés</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
