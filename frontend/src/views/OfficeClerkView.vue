<script setup>
import CreateUserModal from '../components/CreateUserModal.vue';
import UserTable from '../components/UserTable.vue';
import { ref } from "vue";

const createUserModalRef = ref(null);

function openCreateUserModal() {
  createUserModalRef.value.openModal();
}
</script>

<template>
  <h1>OfficeClerk</h1>
  <a class="btn btn-primary m-3" @click="openCreateUserModal">
    Új ügyintéző létrehozása
  </a>
  <CreateUserModal ref="createUserModalRef" />
  <UserTable />
</template>

<style scoped>

</style>

