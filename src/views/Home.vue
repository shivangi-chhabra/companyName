<template>
<div>
    <Header />
  <main class="site-main">
        <section class="hero_area">
            <div class="hero_content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>COMPANY NAME</h1>
                            <h2>Donec Elit Non Porta Gravida Eget Metus</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       <section class="boxes_area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="box">
                            <h3>FIRST BOX TITLE</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id pulvinar magna. Aenean accumsan iaculis lorem, nec sodales lectus auctor tempor.</p>
                            <i class="fa fa-cogs"></i>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box">
                            <h3>SECOND BOX TITLE</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id pulvinar magna. Aenean accumsan iaculis lorem, nec sodales lectus auctor tempor.</p>
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box">
                            <h3>THIRD BOX TITLE</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id pulvinar magna. Aenean accumsan iaculis lorem, nec sodales lectus auctor tempor.</p>
                            <i class="fa fa-clipboard"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Service />
        <section class="home-area">
            <div class="home_content">
                <div class="container">
                    <div class="row">
                        <LatestNews />
                        <Refrence />
                        <Call />
                    </div>
                </div>
            </div>
        </section>
    </main>
    <Footer />
</div>
</template>

<script>

import axios from 'axios' //eslint-disable-line
import Call from '@/components/Call.vue' 
import Header from "@/components/Header.vue";
import Footer from "@/components/Footer.vue"
import Service from "@//components/Service.vue"
import LatestNews from "@/components/LatestNews.vue";
import Refrence from "@/components/Refrence.vue";
  export default {
  name: 'Home',
  components: {
      Call,
      Header,
      Footer,
      Service,
      LatestNews,
      Refrence
      
  },

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

        axios.post('')
        .then((response)=>{ console.log(response);
        })
        .catch((error) => { console.log(error);
        });

    }

  },
     

    

   
}  
    </script>
    