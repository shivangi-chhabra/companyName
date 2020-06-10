<template>
    <div id="menu" class="re_menu">
        <button class="re_menu"><router-link to="/add">Add Records</router-link></button>
        <button class="re_menu"><router-link to="/update">Update Records</router-link></button>
        <button class="re_menu"><router-link to="/delete">Delete Records</router-link></button>
        <button class="re_menu"><router-link to="/view">View Records</router-link></button>
    </div>
</template>
<script>

export default {
    
    name: 'Menu'
}
</script>