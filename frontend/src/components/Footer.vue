<script setup>
import { RouterLink } from "vue-router";
</script>

<template>
  <div class="container-fluid">
    <footer class="py-3 my-4">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item">
          <RouterLink class="nav-link px-2 text-muted" to="/"
            >Főoldal</RouterLink
          >
        </li>
        <li class="nav-item">
          <RouterLink class="nav-link px-2 text-muted" to="/office_clerk"
            >Ügyintézők</RouterLink
          >
        </li>
        <li class="nav-item">
          <RouterLink class="nav-link px-2 text-muted" to="/tasks"
            >Feladatok</RouterLink
          >
        </li>
      </ul>
      <p class="text-center text-muted">© 2022 Company, Inc</p>
    </footer>
  </div>
</template>

<style scoped>
</style>
