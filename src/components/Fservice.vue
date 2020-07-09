<template>
    <div class="col-md-3 col-sm-6 col-xs-12 fbox">
                    <h4>SERVICES</h4>
                    <ul class="big" >
                        
                        <li v-for="element in practice" :key="element.id"><a :href="element.Link" title="">{{element.Name}}</a></li>

                    </ul>
    </div>
</template>
<script>
import axios from 'axios'


 export default{
  name: '',
  
   data:() =>{
    return{
      practice:[]
    }
    },
     methods: {
        getPractice: function () {
         axios
      .get('http://localhost/admin/services.php')
      .then(response => {
        this.practice = response.data
      })
      }
    },
 
    beforeMount() {
      this.getPractice()
    }
}
</script>