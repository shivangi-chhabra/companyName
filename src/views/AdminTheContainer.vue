<template>
<div>

 <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Menu Bar</h3>
        </div>

        <ul class="list-unstyled components">
            <p>Content</p>
            <li class="active">
              <router-link to='/' data-target="#home" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Home </router-link>
               <!-- <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>-->
                
            <li>
                <router-link to='/editHeader' data-target="#editheader" style="color: #fff" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Header </router-link>
            </li>
            <li>
                <a style="color: #fff" href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Footer</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <router-link style="color: #fff" to='/services' data-target="#services" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Services </router-link>
                    </li>
                    <li>
                        <router-link  style="color: #fff" to='/editfooter' data-target="#editfooter" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Contact </router-link>
                    </li>
                    
                </ul>
            </li>
            <li >
                <router-link style="color: #fff" to= '/addnews' data-target="#addnews" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Latest News </router-link>
            </li>
            <li>
                 <router-link  style="color: #fff" to='/editservice' data-target="#editservice" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Service </router-link>
            </li>
            <li>
                 <router-link  style="color: #fff" to='/logout' data-target="#logout" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Log Out </router-link>
            </li>
        </ul>
    </nav>
     <router-view />
</div>
</div>
</template>
<script>

</script>
<style>
@import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
.wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
}
#sidebar {
    min-width: 250px;
    max-width: 250px;
    min-height: 100vh;
}

#sidebar.active {
    margin-left: -250px;
}
a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}
#sidebar {
    /* don't forget to add all the previously mentioned styles here too */
    background: #7386D5;
    color: #fff;
    transition: all 0.3s;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #6d7fcc;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}
#sidebar ul li a:hover {
    
    background: #fff;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: #fff;
    background: #6d7fcc;
}
ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    
    
}

@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
}
</style>
