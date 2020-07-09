<template>
    <div>
    <div class="col-sm-12"><h2 class="sub_title">LATEST NEWS</h2></div>
                        <div class="home_list">
                            <ul>
                                <li class="col-md-3 col-sm-6 col-xs-12" v-for="element in practice" :key="element.id">
                                    <div class="thumbnail">
                                        <img :src="'data:image.png;base64,' + element.image" alt="Post">
                                        <div class="caption">
                                            <h3><a href="#">{{element.Heading}}</a></h3>
                                            <p>{{element.Text}}</p>
                                            <a href="#" class="btn btn-link" role="button">More</a>
                                        </div>
                                    </div>                                        
                                </li>
                                                        
                            </ul>
    </div>
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
      .get('http://localhost/admin/news.php')
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