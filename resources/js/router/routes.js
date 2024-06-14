import Login from "../pages/Login.vue"
import Register from "../pages/Register.vue"
import Home from "../pages/Home.vue"
import Projects from "../pages/Projects.vue"
import ProjectDetail from "../pages/ProjectDetail.vue"
import TaskDetail from "../pages/TaskDetail.vue"
import Statistics from "../pages/Statistics.vue"
import NotFound from "../pages/NotFound.vue"

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/projects',
        component: Projects
    },
    {
        path: '/projects/:id',
        component: ProjectDetail
    },
    {
        path: '/tasks/:id',
        component: TaskDetail
    },
    {
        path: '/statistics',
        component: Statistics
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    }
];

export default routes;
