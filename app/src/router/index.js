import Vue from 'vue'
import VueRouter from 'vue-router'
import LayoutLogin from '../layouts/Login'
import Login from '../modules/login/view/Login'
import Todo from '../modules/todos/view/Todo'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    component: LayoutLogin,
    children: [
      {path: '', name: 'Login', component: Login }
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
