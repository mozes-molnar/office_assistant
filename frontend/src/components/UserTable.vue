<script>
import axios from "axios";
import CreateUserModal from "./CreateUserModal.vue";

export default {
  components: {
    CreateUserModal,
  },
  data() {
    return {
      users: [],
      isEditModalVisible: false,
      selectedUser: null,
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      await axios
        .get(`${import.meta.env.VITE_API_URL}/office_clerk`)
        .then((response) => {
          console.log(response);
          this.users = response.data;
        })
        .catch((err) =>
          console.error("Hiba történt az ügyintézők betöltésekor:", err)
        );
    },
    async editUser(user) {},
    async deleteUser(user) {
      const confirmation = confirm(
        "Biztosan törölni szeretné ezt az ügyintézőt?"
      );
      if (confirmation) {
        try {
          await axios.delete(`${import.meta.env.VITE_API_URL}/office_clerk/${user.id}`);
          this.users = this.users.filter((u) => u.id !== user.id);
        } catch (error) {
          console.error("Hiba történt az ügyintéző törlésekor:", error);
        }
      }
    },
  },
};
</script>

<template>
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
            <a class="btn btn-warning" @click="editUser(user)">Szerkesztés</a>
            <a class="btn btn-danger ms-2" @click="deleteUser(user)">Törlés</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
</style>