import Vue from 'vue'
import App from './App.vue'
import router from './router'


import 'jquery'

import './assets/css/bootstrap.min.css'


import './assets/css/font-awesome.min.css'
import './assets/css/style.css'
import './assets/css/loginStyle.css'
import '../node_modules/mdbvue/lib/mdbvue.css'
import '../node_modules/mdbvue/lib/css/mdb.min.css'


import 'vue-videobg'

import 'solid-js'


import 'mdbvue'


import axios from'./backend'



Vue.config.productionTip = false

new Vue({
  router,
  axios,
  render: h => h(App)
}).$mount('#app')
