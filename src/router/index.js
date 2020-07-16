import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Page from '../views/Page.vue'
import Category from '../views/Category.vue'
import Login from '../views/Login.vue'
import Menu from '../views/Menu.vue'
import Add from '../views/Add.vue'
import AdminTheContainer from '../views/AdminTheContainer.vue'
import Practice from '../views/Practice.vue'
import SignUp from '../views/SignUp.vue'
import EditHeader from '../views/EditHeader.vue'
import EditService from '../views/EditService.vue'
import Services from '../views/Services.vue'
import Addnews from '../views/Addnews.vue'
//import Admin from '../views/Admin.vue'


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
    path: '/adminthecontainer',
    name: 'Adminthecontainer',
    component: AdminTheContainer,
    
        meta: {
          requiresAuth: true
      },
    
    children: [
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
      },
      {
        path: '/add',
        name: 'Add',
        component: Add
      }

    ]
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
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  const authenticatedUser = null;
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);

  if (requiresAuth && ! authenticatedUser) next('login')
  else next();
});
export default router
