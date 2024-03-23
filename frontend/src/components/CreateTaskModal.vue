<script setup>
import { ref, defineExpose, onMounted } from "vue";
import axios from "axios";

const officeClerkId = ref("");
const description = ref("");
const officeClerks = ref([]);
const editedTaskId = ref("");
const disableSelectBox = ref(false);
const emit = defineEmits(["created-task"]);

onMounted(async () => {
  try {
    const response = await axios.get(
      `${import.meta.env.VITE_API_URL}/office_clerk`
    );
    officeClerks.value = response.data;
  } catch (error) {
    console.error("Hiba történt az ügyintézők lekérdezésekor:", error);
  }
});

async function submitForm(event) {
  event.preventDefault();

  if (editedTaskId.value === "") {
    const response = await axios.post(`${import.meta.env.VITE_API_URL}/tasks`, {
      office_clerk_id: officeClerkId.value,
      description: description.value,
    });
  } else {
    const response = await axios.put(
      `${import.meta.env.VITE_API_URL}/tasks/${editedTaskId.value}`,
      {
        office_clerk_id: officeClerkId.value,
        description: description.value,
      }
    );
  }

  emit("created-task", {
    office_clerk_id: officeClerkId.value,
    description: description.value,
  });


  closeModal();
}

async function getTaskDataById(id) {
  axios.get(`${import.meta.env.VITE_API_URL}/tasks/${id}`).then((result) => {
    officeClerkId.value = result.data.office_clerk_id;
    description.value = result.data.description;
  });
}

function openModal(id = null, assignedUserId = null) {
  editedTaskId.value = id ?? "";
  if (id) {
    getTaskDataById(id);
  } else if (assignedUserId !== null) {
    officeClerkId.value = assignedUserId;
    disableSelectBox.value = true;
  }
  document.querySelector("#modal1").style.display = "block";
}

function closeModal() {
  officeClerkId.value = "";
  description.value = "";
  editedTaskId.value = "";
  disableSelectBox.value = false;
  document.querySelector("#modal1").style.display = "none";
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
    id="modal1"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <span v-if="editedTaskId === ''">Új feladat létrehozása</span>
            <span v-else>Feladat módosítása</span>
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
              <label>Ügyintéző neve:</label>
              <select
                class="form-control"
                v-model="officeClerkId"
                required
                :disabled="disableSelectBox"
              >
                <option
                  v-for="clerk in officeClerks"
                  :key="clerk.id"
                  :value="clerk.id"
                >
                  {{ clerk.name }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label>Leírás:</label>
              <textarea
                type="text"
                class="form-control"
                v-model="description"
                required
              />
            </div>
            <button type="submit" class="btn btn-primary">
              <span v-if="editedTaskId === ''">Létrehozás</span>
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
