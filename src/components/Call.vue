<template>
    <div class="col-sm-3">
    <h2 class="sub_title w10">CALL YOU</h2>
    <div class="clearfix"></div>
    <div class="login-form-1">
        <form id="login-form" class="text-left">
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="ad" class="sr-only">Name</label>
                        <input type="text" class="form-control" id="ad"  name="ad" v-model="People.ad" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="tel" class="sr-only">Phone Number</label>
                        <input type="text" class="form-control" id="tel" name="tel" v-model="People.tel" placeholder="Phone Number">
                    </div>
                </div>
                <button id="myForm" type="submit" class="login-button" @click="addToAPI"><i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
    </div>                            
     </div>
    
</template>
<script>
import $ from'jquery'
import axios from 'axios'
  export default {
  name: 'Home',
  props: {
    
  },
  data(){

      return{
          People:{ad:'',tel:''}
      }

  },
  methods:{
      addToAPI(){

        let newPerson = {
            ad: this.People.ad,
            tel: this.People.tel
        }

        console.log(newPerson);

        axios.post('http://localhost/companyName/index.php',newPerson)
        .then((response)=>{ console.log(response);
        })
        .catch((error) => { console.log(error.response);
        });

    }

  },
     mounted(){

       $("#login-form").submit(function(e) {
    e.preventDefault();
});
}      
}  
 </script>