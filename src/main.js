import Vue from 'vue'
import App from './App.vue'
import router from './router'

import 'jquery'

import 'bootstrap'
import './assets/css/bootstrap.min.css'

import './assets/css/font-awesome.min.css'
import './assets/css/style.css'


import './assets/fonts/fontawesome-webfont.svg'




Vue.config.productionTip = false

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
