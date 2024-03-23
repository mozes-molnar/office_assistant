<script setup>
import CreateUserModal from "../components/CreateUserModal.vue";
import CreateTaskModal from "../components/CreateTaskModal.vue";
import UserTable from "../components/UserTable.vue";
import { ref } from "vue";

const createUserModalRef = ref(null);
const createTaskModalRef = ref(null);

function editUser(user) {
  createUserModalRef.value.openModal(user.id);
}

function openCreateUserModal() {
  createUserModalRef.value.openModal();
}

function createTask(user) {
  createTaskModalRef.value.openModal("", user.id);
}
</script>

<template>
  <div class="d-flex justify-content-center">
    <h1 class="mt-3">Ügyintézők kezelése</h1>
  </div>
  <a class="btn btn-primary m-3" @click="openCreateUserModal">
    Új ügyintéző létrehozása
  </a>
  <CreateUserModal ref="createUserModalRef" />
  <CreateTaskModal ref="createTaskModalRef" />
  <UserTable @create-task="createTask" @edit-user="editUser" />
</template>

<style scoped></style>
