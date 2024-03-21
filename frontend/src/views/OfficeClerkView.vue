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
  createTaskModalRef.value.openModal();
}
</script>

<template>
  <h1>OfficeClerk</h1>
  <a class="btn btn-primary m-3" @click="openCreateUserModal">
    Új ügyintéző létrehozása
  </a>
  <!-- <CreateTaskModal ref="createTaskModalRef" /> -->
  <CreateUserModal ref="createUserModalRef" />
  <UserTable @create-task="createTask" @edit-user="editUser" />
</template>

<style scoped></style>
