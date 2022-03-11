import {createRouter,createWebHistory} from "vue-router";


import Dashboard from "../views/Dashboard.vue";
import Register from "../views/Register.vue";
import Login from "../views/Login.vue";
import Forums from '../views/Forums.vue';
import Post from '../views/Post.vue';
import Topic from "../views/Topic.vue";


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
    },
    {
        path: '/forums',
        name: 'forums',
        component: Forums
    },
    {
        path: '/topic/:id',
        name: 'topic',
        component: Topic
    },
    {
        path: '/post/:id',
        name: 'post',
        component: Post
    },


]


const router = createRouter( {

    history : createWebHistory(),
    routes

})

export default router;
