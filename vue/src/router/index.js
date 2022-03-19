import {createRouter,createWebHistory} from "vue-router";


import Dashboard from "../views/Dashboard.vue";
import Register from "../views/Register.vue";
import Login from "../views/Login.vue";
import Forums from '../views/Forums.vue';
import Post from '../views/Post.vue';
import Topic from "../views/Topic.vue";
import DefaultLayout from "../components/DefaultLayout.vue";


const routes = [

    {
      path :'/',
      redirect: '/forums',
      component: DefaultLayout,
      children : [
          {
              path : '/dashboard',
              name  : 'dashboard',
              component : Dashboard
          },
          {
              path: '/',
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
    },
    // {
    //     path : '/',
    //     name  : 'dashboard',
    //     component : Dashboard
    // },
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



]


const router = createRouter( {

    history : createWebHistory(),
    routes

})

export default router;
