import Vue from "vue";
import Vuex from "vuex";
import container from './container';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    thecontainer: container,
    
  },
});