<script setup>
import { ref } from "vue";
import TaskTable from "../components/TaskTable.vue";
import CreateTaskModal from "../components/CreateTaskModal.vue";

const createTaskModalRef = ref(null);

function openCreateUserModal() {
  createTaskModalRef.value.openModal();
}

function editTask(task) {
  createTaskModalRef.value.openModal(task.id);
}
</script>

<template>
  <h1>Task</h1>
  <a class="btn btn-primary m-3" @click="openCreateUserModal">
    Új feladat létrehozása
  </a>
  <CreateTaskModal ref="createTaskModalRef" />
  <TaskTable @edit-task="editTask" />
</template>

<style scoped></style>
