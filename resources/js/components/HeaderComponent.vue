<template>
<div class="header">
    <router-link to="/">
        <h4>Hotel</h4>
    </router-link> 
    <nav>
        <div v-if="loggedIn" :class="barClass">
            <ul>
                 <li>Account</li>   <!-- , logout -->
               
                <li><router-link to="/">Bookings</router-link></li>
                <li><a href="javascript:void(0);" onclick="myfunction()"><i class="fa fa-bars"></i></a></li>
            </ul>
        </div>
        <div v-else  :class="barClass">
            <ul>
                <li><router-link to="/">Login</router-link></li>
                <li><router-link to="/">Signup</router-link></li>
                <li><router-link to="/">Bookings</router-link></li>
                <li><a href="javascript:void(0);" :click="myfunction"><i class="fa fa-bars"></i></a></li>
            </ul>
        </div>
    </nav>
</div>
</template>

<script>
export default {
    data () {
        return {
            loggedIn: false,
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
    font-family: 'Circular-Book'
}
.header {
    display: flex;
    flex-direction: row;
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
    float: right; 
}
.topnav ul>li {
    display: inline;
}

@media screen and (max-width: 600px) {
    .topnav{
        display: none;
    }
}
</style>

