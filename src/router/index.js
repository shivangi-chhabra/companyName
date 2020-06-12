import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Page from '../views/Page.vue'
import Category from '../views/Category.vue'
import Login from '../views/Login.vue'
import Menu from '../views/Menu.vue'
import Add from '../views/Add.vue'
import Update from '../views/Update.vue'
import Delete from '../views/Delete.vue'
import View from '../views/View.vue'


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
    path: '/update',
    name: 'Update',
    component: Update
  },
  {
    path: '/delete',
    name: 'Delete',
    component: Delete
  },
  {
    path: '/view',
    name: 'View',
    component: View
  }
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
