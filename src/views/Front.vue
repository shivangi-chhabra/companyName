<template>
    <div>
        <div id="img" :style="{'background-image': 'url(' + require('../assets/img/images1.jpg')+')'}">
        <div class="container" id="abc">
        <img src="../assets/img/download.png">
        <H1>Online Attendence Register</H1> 
        </div>
        <div id="store">
        <button class="btn">SignUp</button>
        <br>
        <br>
        <button class="btn">LogIn</button>
        
        </div>
        
        </div>
        <FrontFooter />
    </div>
</template>
<style scoped>
#abc{
    display: flex;
    margin-left: 200px;
}
h1{
    margin-top: 52px;
}
.btn{
    margin-right: 200px;
}
#store{

    padding-left: 500px;
    padding-bottom: 180px;
}
#img{
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
 
}

</style>
<script>
import FrontFooter from '../components/FrontFooter'
export default {
    components:{
        FrontFooter
    }
    
}
</script>