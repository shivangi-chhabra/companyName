<template>
<div id="con">
<form action="" method="post" class="adlog" @submit="checkForm" enctype='multipart/form-data'>
  <div class="imgcontainer">
    <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="cont">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required id="username" v-model="username">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required id="password" v-model="password">

    <button class="adlog" type="submit" name="login" id="login_form">Login</button>
    <label>
      <input class="adlog" type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>
  <div class="cont" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn" ><router-link to = '/'> Cancel </router-link></button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
</div>
</template>
<script>

import axios from "axios" //eslint-disable-line

export default {
  name: 'Home',
  data(){
    return {
      errors: [],
      username: null,
      password: null,
    }
  },
  methods:{
    checkForm: function (e) {
      e.preventDefault();
      if (this.username && this.password) {
        axios(
          { 
            method: "POST" ,
            url   : "http://localhost/admin/",
            data: {
                      username: this.username,
                      password: this.password  
            }       
          }).then((result)=>{
          console.log(result.data);
          this.response = result.data;
        })
      }

      this.errors = [];

      if (!this.username) {
        this.errors.push('Name required.');
      }
      if (!this.password) {
        this.errors.push('Phone Number required.');
      }  
    }
  }

  }
</script>
