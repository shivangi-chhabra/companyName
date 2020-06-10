<template>
    <div class="col-sm-3">
    <h2 class="sub_title w10">CALL YOU</h2>
    <div class="clearfix"></div>
    <div class="login-form-1">
        <div id="sendmessage">Your message has been sent. Thank you!</div>
              <div id="errormessage"></div>
        <form id="login-form" class="text-left" @submit="checkForm" method="post" role="form" action="" enctype='multipart/form-data'>
            <p v-if="errors.length">
                  <b>Please correct the following error(s):</b>
                  <ul>
                    <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
                  </ul>
                </p>
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="ad" class="sr-only">Name</label>
                        <input type="text" class="form-control" id="ad"  name="ad" v-model="ad" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="tel" class="sr-only">Phone Number</label>
                        <input type="text" class="form-control" id="tel" name="tel" v-model="tel" placeholder="Phone Number">
                    </div>
                </div>
                <button name ="submit" id="myForm" type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
    </div>                            
     </div>
    
</template>
 <script>
//import $ from "jquery"
import axios from "axios" //eslint-disable-line

export default {
  name: 'call',
  data(){
    return {
      errors: [],
      ad: null,
      tel: null,
    }
  },
  methods:{
    checkForm: function (e) {
      e.preventDefault();
      if (this.ad && this.tel) {
        axios(
          { 
            method: "POST" ,
            url   : "http://localhost/companyName/",
            data: {
            
                      ad: this.ad,
                      tel: this.tel  
            }       
          }).then((result)=>{
          console.log(result.data);
          this.response = result.data;
        })
      }

      this.errors = [];

      if (!this.ad) {
        this.errors.push('Name required.');
      }
      if (!this.tel) {
        this.errors.push('Phone Number required.');
      }
      
    }
  }

  }
</script>