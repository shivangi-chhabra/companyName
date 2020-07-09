<template>
        <section class="services">
            <h2 class="section-title">SERVICES</h2>
            
            <p class="desc">Praesent faucibus ipsum at sodales blandit</p>
            
            <div class="container" >
                <div class="row" >
                    <div class="col-md-4 col-sm-6 col-xs-12" v-for="element in practice" :key="element.id">
                        <div class="media">
                            <div class="media-left media-middle">
                                <i :class="element.Class"></i>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{element.Heading}}</h4>
                                <p>{{element.Text}}</p>
                            </div>
                        </div>
                    </div>                  
                </div>
            </div>
           
        </section>
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
      .get('http://localhost/admin/comp.php')
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