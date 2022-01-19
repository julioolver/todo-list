import Vue from 'vue'
import VueRouter from 'vue-router'
import LayoutLogin from '../layouts/Login'
import Login from '../modules/login/view/Login'
import Default from '../layouts/Default'
import Todo from '../modules/todos/view/Todo'
import Home from '../modules/home/view/Home'
import Guard from '@/services/middleware'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    beforeEnter: Guard.redirectIfNotAuthenticated,
    component: Default,
    children: [
      {path: '', name: 'index', component: Home }
    ]
  },
  {
    path: '/login',
    component: LayoutLogin,
    beforeEnter: Guard.redirectIfAuthenticated,
    children: [
      {path: '', name: 'login', component: Login }
    ]
  },
  {
    path: '/about',
    name: 'About',
    component: LayoutLogin,
    children: [
      {path: '', name: 'Todo', component: Todo }
    ]
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    //component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  }
]

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router
