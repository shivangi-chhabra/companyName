import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Page from '../views/Page.vue'
import Category from '../views/Category.vue'
import Login from '../views/Login.vue'
import Menu from '../views/Menu.vue'
import Add from '../views/Add.vue'
import TheContainer from '../views/TheContainer.vue'
import Practice from '../views/Practice.vue'
import SignUp from '../views/SignUp.vue'
import EditHeader from '../views/EditHeader.vue'


Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/page',
    name: 'Page',
    component: Page
  },
  {
    path: '/category',
    name: 'Category',
    component: Category
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/menu',
    name: 'Menu',
    component: Menu
  },
  {
    path: '/Add',
    name: 'Add',
    component: Add
  },
  {
    path: '/thecontainer',
    name: 'TheContainer',
    component: TheContainer
  },
  {
    path: '/practice',
    name: 'Practice',
    component: Practice
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUp
  },
  {
    path: '/editheader',
    name: 'EditHeader',
    component: EditHeader
  }
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
