<template>
    <b-container>
        <b-row class="center-form">
            <b-col md="3"/>
             <b-col md="6">
                 <b-card title="COWU CROWN HOTEL">
                    <b-form>
                       
                        <h4 class="register">Register</h4><br>
                        <b-form-input v-model="firstName" type="text" placeholder="First name" name="first-name" data-vv-as="First Name" v-validate="'required'"/><span class="error">{{ errors.first('first-name') }}</span><br>
                        <b-form-input v-model="lastName" type="text" placeholder="Last name" name="last-name" data-vv-as="Last Name" v-validate="'required'"/><span class="error">{{ errors.first('last-name') }}</span><br>
                        <b-form-input v-model="email" type="text" placeholder="Email" name="email" v-validate="'required|email'"/><span class="error">{{ errors.first('email') }}</span><br>
                        <b-form-input v-model="phone" type="text" placeholder="Phone number" name="phone" v-validate="'required'"/><span class="error">{{ errors.first('phone') }}</span><br>
                        <b-form-input v-model="password" type="password" placeholder="Password" name="password" v-validate="'required|min:6'" data-vv-as="Password"/><span class="error">{{ errors.first('password') }}</span><br>
                        <b-form-input v-model="confirmPassword" type="password" placeholder="Confirm Password" name="confirm-password" v-validate="'required|min:6'" data-vv-as="Confirm password"/><span class="error">{{ errors.first('confirm-password') }}</span><br>
                        <b-button block variant="primary" @click="register()">
                            <b-spinner v-if="showLoading" small></b-spinner>
                            <span class="sr-only">Loading...</span>
                            Register
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
            firstName: '',
            lastName: '',
            email: '',
            phone: '',
            password: '',
            confirmPassword: '',
            showLoading: false,
        }
    },
    methods: {
        register() {
           this.$validator.validate().then(valid => {
                if (!valid){
                    return;
                }
                this.showLoading = true;
                this.axios.post('/api/signup', {
                    firstName: this.firstName,
                    lastName: this.lastName,
                    email: this.email,
                    phone: this.phone,
                    password: this.password
                })
                .then(response=>{
                    console.log("data is ",response.data);
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
