<template>
    <b-container>
        <b-row>
            <b-col lg="5">
                 <img class="image" src="/images/her_image.jpg"/>
            </b-col>
            <b-col lg="7">
                <b-row>
                    <b-col lg="4">
                        <p>check in date</p>
                        <b-form-input :id="`type-${type}`" :type="'date'"></b-form-input>
                    </b-col>
                    <b-col lg="4">
                        <p>check out date</p>
                        <b-form-input :id="`type-${type}`" :type="'date'"></b-form-input>
                    </b-col>
                    <b-col lg="4">
                        <p>Adults</p>
                        <b-form-input :type="'text'"></b-form-input>
                    </b-col>
                </b-row>
                <b-row>
                    <span>N 1200</span><span><input type="text"/></span>
                </b-row>
                <b-row>
                    <b-button block variant="primary">Book Room</b-button>
                </b-row>
            </b-col>
            
        </b-row>
    </b-container>
</template>


<script>
import {mapGetters} from 'vuex'


export default {
    computed: {
        ...mapGetters('payment', {
            showPayment: 'showPayment',
        })
    },
    data () {
        return {
            checkInDate: '',
            checkOutDate: '',
            noOfNights:0,
            noOfAdults:0,
            noOfRooms: 0,
        }
    },
    methods: {
        validateInput() {
            if (this.noOfNights==0) {
                return;
            }
            if (this.noOfRooms==0) {
                return;
            }
        },

        book() {
            if (localStorage.getItem(__authToken__)) {
                showPaystack();
                return
            }
            showLogin();
        },

        showLogin() {
            this.$router.push('/login');
        },
        
        showPaystack() {
            var handler = PaystackPop.setup({
            key: 'pk_test_7dfcdc2c0d8e91d525e52ee606b01e707b805b09',
            email: 'customer@email.com',
            amount: 10000,
            currency: "NGN",
            ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            metadata: {
                custom_fields: [
                    {
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: "+2348012345678"
                    }
                ]
            },
            callback: function(response){
                alert('success. transaction ref is ' + response.reference);
            },
            onClose: function(){
                alert('window closed');
            }
            });
            handler.openIframe();
        }
    },
    //------------  LIFE CYCLE HERE -------------
    mounted () {
        console.log("mounted");
        console.log("show payment is ", this.showPayment);
        if (this.showPayment) {
            this.showPaystack();
            return;
        }
    },
    updated () {
        console.log("vue updated");
    }   
}
</script>




<style>
.image {
    height: 100%;
    width: 100%;
}
</style>

