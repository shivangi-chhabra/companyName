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
import EditService from '../views/EditService.vue'
import Services from '../views/Services.vue'
import Addnews from '../views/Addnews.vue'



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
  },
  {
    path: '/editservice',
    name: 'EditService',
    component: EditService
  },
  {
    path: '/services',
    name: 'Services',
    component: Services
  },
  {
    path: '/addnews',
    name: 'Addnews',
    component: Addnews
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
