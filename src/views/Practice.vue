<template>
<div>
         <header class="site-header">
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Lorem Ipsum Dolor Sit Amet</p>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-inline pull-right">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i></a></li>
                            <li><a href="tel:+902222222222"><i class="fa fa-phone"></i> +90 222 222 22 22</a></li>
                        </ul>                        
                    </div>
                </div>
            </div>
        </div>                  
        <nav class="navbar navbar-default">
			<div class="container">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<i class="fa fa-bars"></i>
				</button>
				<router-link to = '/' class="navbar-brand">
					<img src="../assets/img/logo.png" alt="Post">
				</router-link>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-navbar-collapse">
                    <ul class="nav navbar-nav main-navbar-nav">
                        <li v-for="element in practice" :key="element">
                    <router-link :to="element.Link">{{element.Name}}</router-link>
                 </li>
                    </ul>                           
                </div><!-- /.navbar-collapse -->                
				<!-- END MAIN NAVIGATION -->
			</div>
		</nav>        
    </header>
    <Footer />
</div>
</template>
<script>
import axios from 'axios'
import Footer from "../components/Footer"

 export default{
  name: 'Practice',
  components:{
     Footer
  },
   data:() =>{
    return{
      practice:[]
    }
    },
     methods: {
        getPractice: function () {
         axios
      .get('http://localhost/admin/header.php')
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