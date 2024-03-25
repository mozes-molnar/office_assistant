import { createRouter, createWebHistory } from "vue-router";

import OfficeClerksView from "./views/OfficeClerkView.vue";
import TasksView from "./views/TaskView.vue";

const routes = [
  { path: "/", redirect: "/office_clerk" },
  { path: "/office_clerk", component: OfficeClerksView },
  { path: "/tasks", component: TasksView },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
