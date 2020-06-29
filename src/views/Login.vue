<template>
<div id="con">
<form action="" method="post" id='form' class="adlog" @submit="login" enctype='multipart/form-data'>
  <div class="imgcontainer">
    <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="cont">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username"  autofocus id="username" v-model="username">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" v-model="password">
    
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
export default {
  name: 'Login',
  data () {
    return {
      username: '',
      password: '',
      error: false
    }
  },
  methods: {
    login () {
      
      this.$http.post('/index.php', { username: this.username, password: this.password })
    .then(request => {
      console.log(request);
      if(request.status === 200) {
        this.loginSuccessful(request)  
      } else {
        this.loginFailed()  
      }            
    })
    .catch(() => {  
      this.loginFailed()
    })
    },
    loginSuccessful () {
    //  if (!req.data.token) {
    // this.loginFailed()
    // return
    //  }

     // localStorage.token = req.data.token
     this.error = false
      console.log('----');
     this.$router.replace('/menu')
     },

    loginFailed () {
    this.error = 'Login failed!'
    delete localStorage.token
    }
  }
}
</script>