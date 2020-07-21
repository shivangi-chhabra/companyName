<template>
    <div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    methods:{
    logout() {
                axios.post('http://localhost/admin/logout.php').then(response => {
                    if (response.status === 401) {
                        console.log('logout')
                    }
                }),
                localStorage.removeItem('token')

                this.$router.replace('/')
              },  
    },
    beforeMount(){
        this.logout()
    }
}
</script>