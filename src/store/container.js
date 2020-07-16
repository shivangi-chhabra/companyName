import Api from "../Services/api";


export default {
  namespaced: true,
  state: {
    users: [],
    currentUser: {}
  },
  mutations: {
   
    SET_USERS(state, users) {
      state.users = users;
    },
    
  },
  actions: {
    async loadAll({commit}) {
      let response = await Api().get('/container');
      let users = response.data.data;
      commit('SET_USERS', users.map(u => u.attributes));
    }
}
}