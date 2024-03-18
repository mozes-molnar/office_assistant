import { createApp } from 'vue'
import { createMemoryHistory, createRouter } from 'vue-router'
import App from './App.vue'
import OfficeClerkView from './views/OfficeClerkView.vue'
import TaskView from './views/TaskView.vue'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'

const routes = [
    { path: '/', component: OfficeClerkView},
    { path: '/task', component: TaskView},
]

const router = createRouter({
    history: createMemoryHistory(),
    routes,
})


createApp(App).use(router).mount('#app')
