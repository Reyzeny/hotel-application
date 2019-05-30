<template>
    <b-container>
        <b-row class="center-form">
            <b-col md="3"/>
             <b-col md="6">
                 <b-card title="COWU CROWN HOTEL">
                    <b-form>
                       
                        <h4 class="register">Login</h4><br>
                        <b-form-input v-model="email" type="text" placeholder="Email" name="email" v-validate="'required|email'"/><span class="error">{{ errors.first('email') }}</span><br>
                        <b-form-input v-model="password" type="password" placeholder="Password" name="password" v-validate="'required|min:6'" data-vv-as="Password"/><span class="error">{{ errors.first('password') }}</span><br>
                        <b-button block variant="primary" @click="login()">
                            <b-spinner v-if="showLoading" small></b-spinner>
                            <span class="sr-only">Loading...</span>
                            Login
                        </b-button>
                    </b-form>
                </b-card>
             </b-col>
            <b-col md="3"/>
        </b-row>
    </b-container>
       
        
    
</template>

<script>
import {mapActions} from 'vuex'
export default {
    data () {
        return {
            email: '',
            password: '',
            showLoading: false,
        }
    },
    methods: {
        login() {
           this.$validator.validate().then(valid => {
                if (!valid){
                    return;
                }
                this.showLoading = true;
                this.axios.post('/api/login', {
                    email: this.email,
                    password: this.password
                })
                .then(response=>{
                    console.log(response);
                    this.showLoading = false;
                    if (response.status==200) {
                        localStorage.setItem("token", response.data.access_token);
                        localStorage.setItem("customerID", response.data.customer.id);
                        localStorage.setItem("first_name", response.data.customer.first_name);
                        localStorage.setItem("last_name", response.data.customer.last_name);
                        this.$router.go(-1);
                        return;
                    }
                })
                .catch(error=>{
                    console.log("error is ", error);
                })
            });
        }
    }
}
</script>


<style>
.center-form {
    margin-top: 50px;
}
.register {
    margin-top: 30px;
}
.error {
    color: red;
}
</style>
