import axios from 'axios';
const url = 'http://localhost';
export default {
  login(credentials) {
    return axios
      .post(url , credentials)
      .then(response => response.data);
  }
  
};