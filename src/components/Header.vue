<template>
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
                        <li class="active"><router-link to ='/' >HOME</router-link></li>
                        <li class="dropdown">
                            <a href="#" title="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">DROPDOWN MENU <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#" title="">SUB MENU 1</a></li>
                                <li><a href="#" title="">SUB MENU 2</a></li>
                                <li><a href="#" title="">SUB MENU 3</a></li>
                            </ul>
                        </li>
                        <li v-for="element in practice" :key="element.id">
                        <router-link :to="element.Link">{{element.Name}}</router-link></li>
                        <li v-if="user">
                   <router-link to="/" @click="logout">Logout</router-link>
              </li>
              <li v-else>
               <router-link to="/login">Login</router-link>
              </li>
                    </ul>                           
                </div><!-- /.navbar-collapse -->                
				<!-- END MAIN NAVIGATION -->
			</div>
		</nav>        
    </header>
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
    created () { 
       this.user= localStorage.getItem('token') || false;
    }, 
     methods: {
        getPractice: function () {
         axios
      .get('http://localhost/admin/header.php')
      .then(response => {
        this.practice = response.data
      })
      },
      logout() {
                axios.post('http://localhost/admin/logout.php').then(response => {
                    if (response.status === 401) {
                        console.log('logout')
                    }
                }),
                localStorage.removeItem('token')

                this.$router.push('/').catch(()=>{});
              },  
    },
    beforeMount() {
      this.getPractice()
      this.logout()
    }
}
</script>