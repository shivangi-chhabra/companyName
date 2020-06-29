
<template>
    <div>
        <h4>Register</h4>
        <form  method="post"  id="form1" @submit.prevent="handleSubmit">
            <label >Username</label>
            <div>
                <input id="username" type="text" v-model="username"  autofocus>
            </div>
            <small>Error message</small>
            <label >Email</label>
            <div>
                <input id="email" type="email" v-model="email" >
            </div>
            <small>Error message</small>
          
            <label >Password</label>
            <div>
                <input id="password" type="password" v-model="password" >
            </div>
            <small>Error message</small>
            <label >Password</label>
            <div>
                <input id="password2" type="password" >
            </div>
            <small>Error message</small>
            <div>
                <button type="submit" name ="submit"  >
                    Register
                </button>
            </div>
        </form>
    </div>
</template>
<script>
//import $ from "jquery"
import axios from "axios" //eslint-disable-line


export default {
  name: 'signup',
  data(){
    return {
      errors: [],
      username: null,
      password: null,
      email: null
    }
  },
  mounted(){
    this.handleSubmit();
  },
 
  methods:{
    handleSubmit: function() {
      if (this.username && this.email && this.password) {
        axios({ method: "POST", 
            url: "http://localhost/admin/register.php", 
            data: {
                      username : this.username,
                      email : this.email,
                      password : this.password,
                    }, 
          }).then(request => { console.log(request);
            if (request.status ===200){
            this.signupSuccessful(request)
            }else{
                this.signupFaild()
            }      
        }).catch(() => {  
      this.signupFaild()
    })
    }
    },
    signupSuccessful () {
    //  if (!req.data.token) {
    // this.loginFailed()
    // return
    //  }

     // localStorage.token = req.data.token
     this.error = false
      console.log('----');
      console.log('hello');
     this.$router.push('/login')
     },

    signupFaild () {
    this.error = 'Login failed!'
    delete localStorage.token
    }
 } 
  }
</script>
