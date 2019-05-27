<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-light header">
        <a class="navbar-brand" href="#">
            <img src="/images/hotel-logo" width="30" height="30" alt="Hotel" class="nav-text-color">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <img src="/images/menu.svg" width="30" height="30"/>
            </span>
        </button>

        <div v-if="loggedIn" class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <router-link class="nav-link nav-text-color" to="/useraccount">Account</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link nav-text-color" to="/bookings">Bookings</router-link>
                </li>
            </ul>
        </div>

        <div v-else class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <router-link class="nav-link nav-text-color" to="/userlogin">Login</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link nav-text-color" to="/usersignup">Signup</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link nav-text-color" to="/bookings">Bookings</router-link>
                </li>
            </ul>
        </div>
    </nav>
</div>
</template>

<script>
export default {
    computed: {
        loggedIn() {
            return localStorage.getItem('authToken')!=null
        }
    },
    data () {
        return {
            barClass: "topnav",
        }
    },
    methods: {
        myfunction() {
            if (barClass==='topnav') {
                barClass += ' responsive'
            }else{
                barClass = 'topnav'
            }
        }
    }
}
</script>

<style lang="scss" scoped>
*{
    font-family: serif;
}
.nav-text-color {
    color: white !important;
}
.header-body {
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px;
}
.topnav {
    overflow: hidden;
}
.topnav ul {
    list-style-type: none;
}
.topnav ul>li {
    display: inline
}

@media screen and (max-width: 600px) {
    .topnav{
        display: none;
    }
}
</style>

