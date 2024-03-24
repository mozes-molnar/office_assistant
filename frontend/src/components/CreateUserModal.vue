<script setup>
import { ref, defineExpose, onMounted } from "vue";
import axios from "axios";

const name = ref("");
const email = ref("");
const description = ref("");
const editedUserId = ref("");
const emit = defineEmits(["created-user"]);

const props = defineProps({
  user_id: String,
});

async function submitForm(event) {
  event.preventDefault();

  if (editedUserId.value === "") {
    const response = await axios.post(
      `${import.meta.env.VITE_API_URL}/office_clerk`,
      {
        name: name.value,
        email: email.value,
        description: description.value,
      }
    );
  } else {
    const response = await axios.put(
      `${import.meta.env.VITE_API_URL}/office_clerk/${editedUserId.value}`,
      {
        name: name.value,
        email: email.value,
        description: description.value,
      }
    );
  }
  emit("created-user", {
    name: name.value,
    email: email.value,
    description: description.value,
  });

  closeModal();
}

async function getUserDataById(id) {
  axios
    .get(`${import.meta.env.VITE_API_URL}/office_clerk/${id}`)
    .then((result) => {
      name.value = result.data.name;
      email.value = result.data.email;
      description.value = result.data.description;
    });
}

function openModal(id = null) {
  if (id !== null) {
    editedUserId.value = id;
    getUserDataById(id);
  }
  document.querySelector("#modal2").style.display = "block";
}

function closeModal() {
  name.value = "";
  email.value = "";
  description.value = "";
  editedUserId.value = "";
  document.querySelector("#modal2").style.display = "none";
}

defineExpose({
  openModal,
});
</script>

<template>
  <div
    class="modal"
    tabindex="-1"
    role="dialog"
    style="display: none"
    id="modal2"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <span v-if="editedUserId === ''">Új ügyintéző létrehozása</span>
            <span v-else>Ügyintéző módosítása</span>
          </h5>
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
              <label>Név:</label>
              <input type="text" class="form-control" v-model="name" required />
            </div>
            <div class="form-group">
              <label>Email:</label>
              <input
                type="email"
                class="form-control"
                v-model="email"
                required
              />
            </div>
            <div class="form-group">
              <label>Leírás:</label>
              <textarea
                class="form-control"
                v-model="description"
                rows="3"
              ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
              <span v-if="editedUserId === ''">Létrehozás</span>
              <span v-else>Módosítás</span>
            </button>
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
