<script setup>
import { ref, defineExpose } from "vue";
import axios from "axios";

let name = ref("");
let email = ref("");
let description = ref("");
let createdAt = new Date();

async function submitForm(event) {
  try {
    const response = await axios.post(
      import.meta.env.VITE_API_URL + "/office_clerk",
      {
        name: name.value,
        email: email.value,
        description: description.value,
        created_at: createdAt,
      }
    );

    closeModal();
  } catch (error) {
    console.error("Hiba történt:", error);
  }
}

function openModal() {
  document.querySelector(".modal").style.display = "block";
}

function closeModal() {
  document.querySelector(".modal").style.display = "none";
}

defineExpose({
  openModal,
});
</script>


<template>
  <div class="modal" tabindex="-1" role="dialog" style="display: none">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Új ügyintéző létrehozása</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            @click="closeModal"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit="submitForm">
            <div class="form-group">
              <label for="name">Név:</label>
              <input type="text" class="form-control" v-model="name" required />
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input
                type="email"
                class="form-control"
                v-model="email"
                required
              />
            </div>
            <div class="form-group">
              <label for="description">Leírás:</label>
              <textarea
                class="form-control"
                v-model="description"
                rows="3"
              ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Létrehozás</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>


<style scoped>
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-dialog {
  position: relative;
  top: 50%;
  transform: translateY(-50%);
}

.modal-content {
  width: 80%;
  max-width: 400px;
  margin: auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
}

.modal-header {
  display: flex;
  justify-content: space-between;
}

.modal-title {
  margin: 0;
}

.close {
  border: none;
  background-color: transparent;
  font-size: 24px;
  cursor: pointer;
}

.modal-body {
  margin-top: 20px;
}

.form-group {
  margin-bottom: 20px;
}
</style>