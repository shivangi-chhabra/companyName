
<template>
    <div id="conn">
        <h4>Register</h4>
        <form  method="post"  id="form1" @submit.prevent="handleSubmit">
            <label >Username</label>
            <div id="signUp">
                <input id="username" type="text" v-model="username"  autofocus>
                <small>Error message</small>
            </div>
            
            <label >Email</label>
            <div id="signUp">
                <input id="email" type="email" v-model="email" >
                <small>Error message</small>
            </div>
            
          
            <label>Password</label>
            <div id="signUp"> 
                <input id="password" type="password" v-model="password" >
                <small>Error message</small>
            </div>
            
            <label >Password</label>
            <div id="signUp">
                <input id="password2" type="password" >
            </div>
            
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
    const form = document.getElementById('form1');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    //const password2 = document.getElementById('password2');
    form.addEventListener('submit', e => {
    e.preventDefault();
    checkInputs();
    });
     function checkInputs() {
    // trim to remove the whitespaces
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    //const password2Value = password2.value.trim();
    
    if(usernameValue === '') {
        setErrorFor(username, 'Username cannot be blank');
    } else {
        setSuccessFor(username);
    }
    
    if(emailValue === '') {
        setErrorFor(email, 'Email cannot be blank');
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Not a valid email');
    } else {
        setSuccessFor(email);
    }
    
    if(passwordValue === '') {
        setErrorFor(password, 'Password cannot be blank');
    } else {
        setSuccessFor(password);
    }
    
    /*if(password2Value === '') {
        setErrorFor(password2, 'Password2 cannot be blank');
    } else if(passwordValue !== password2Value) {
        setErrorFor(password2, 'Passwords does not match');
    } else{
        setSuccessFor(password2);
    }*/
}
function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    formControl.className = 'form-signin error';
    small.innerText = message;
}
function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = 'form-signin success';
}
    
function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);}//eslint-disable-line 
  },
 
  methods:{
    handleSubmit: function() {
      if (this.username && this.email && this.password) {
        axios({ method: "POST", 
            url: "http://localhost/admin/register.php", 
            data: {
                      username : this.username,
                      email    : this.email,
                      password : this.password,
                    }, 
          }).then(request => { console.log(request);
            if (request.status === 200){
            
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
<style >
@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,500&display=swap');


#form1 i {
  visibility: hidden;
  position: absolute;
  top: 40px;
  right: 10px;
}

#form1 small {
  color: #e74c3c;
  visibility: hidden;
}
#signUp.error small {
  visibility: visible;
}
#signUp.error i.fa-exclamation-circle {
  color: #e74c3c;
  visibility: visible;
}
#conn{
    width: 555px;
    margin:auto;
    margin-top:50px;
    padding: 5%;
  }
</style>