import {createRouter,createWebHistory} from "vue-router";


import Dashboard from "../views/Dashboard.vue";
import Register from "../views/Register.vue";
import Login from "../views/Login.vue";


const routes = [
    {
        path : '/',
        name  : 'dashboard',
        component : Dashboard
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    }
]


const router = createRouter( {

    history : createWebHistory(),
    routes

})

export default router;
