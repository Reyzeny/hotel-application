<template>
    <b-container>
        <b-form>
            <b-col md="2"/>
            <b-col md="8">
                <h2>HOTEL</h2>
                <h4>Sign In</h4>
                <b-form-input type="text" placeholder="Email" name="email"/>
                <b-form-input type="text" placeholder="Password" name="email"/>
                <b-button block variant="primary" @click="login()">Login</b-button>
            </b-col>
            <b-col md="2"/>
        </b-form>
    </b-container>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    methods: {
        ...mapActions('payment', ['ASYNC_SHOW_PAYMENT']),
        login() {
            this.ASYNC_SHOW_PAYMENT({showPayment: true});
            this.$router.go(-1);
        }
    }
}
</script>


<style>
form {
    text-align: center;
}
</style>
