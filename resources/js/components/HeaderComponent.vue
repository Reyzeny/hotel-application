<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-light header">
        <router-link class="navbar-brand" to="/">
            <img src="/images/hotel-logo.png" alt="Owu Crown Hotel" class="nav-text-color">
        </router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <img src="/images/menu.svg" width="30" height="30"/>
            </span>
        </button>

        <div v-if="loggedIn" class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-text-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <router-link to="/useraccount" class="dropdown-item" href="#">Profile</router-link>
                        <b-button @click="logout()" class="dropdown-item">Logout</b-button>
                    </div>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link nav-text-color" to="/bookings">
                        Bookings
                    </router-link>
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
            </ul>
        </div>
    </nav>
</div>
</template>

<script>
export default {
    computed: {
        loggedIn() {
            return localStorage.getItem('token')!=null
        }
    },
    data () {
        return {
            barClass: "topnav",
        }
    },
    methods: {
        logout() {
            localStorage.removeItem('token');
            localStorage.removeItem('customerID');
            localStorage.removeItem('first_name');
            localStorage.removeItem('last_name');
            // this.created();
            // this.$forceUpdate();
            this.$router.go();
        }
    }
}
</script>

<style lang="scss" scoped>
*{
    font-family: serif;
}
.nav-text-color {
    color: #81C784 !important;
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

