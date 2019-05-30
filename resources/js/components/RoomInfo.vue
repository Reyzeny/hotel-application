<template>
<div>
    <header-component/>
    <b-container>
        <b-row style="margin-top: 50px;">
            <b-col lg="5">
                 <img class="image" :src="image_url"/>
            </b-col>
            <b-col lg="7">
                <b-row>
                    <h2>{{room_name}}</h2>
                </b-row><br>
                <b-row>
                     <h4>=N= {{price}}</h4>
                </b-row>
                <b-row style="margin-top: 30px;">
                    <b-col lg="6">
                        <label for="check-in-date">Check in date</label>
                        <b-form-input v-model="checkInDate" name="check-in-date" :id="`type-${type}`" :type="'date'"></b-form-input>
                    </b-col>
                    <b-col lg="6">
                        <label for="check-out-date">Check out date</label>
                        <b-form-input v-model="checkOutDate" name="check-out-date" :id="`type-${type}`" :type="'date'"></b-form-input>
                    </b-col>
                </b-row ><br>
                <b-row>
                    <b-col lg="4">
                        <label for="no_of_rooms">Number of rooms</label>
                        <b-form-input v-model="noOfRooms" name="no_of_rooms" :type="'text'"></b-form-input>
                    </b-col>
                    <b-col lg="4">
                        <label for="no_of_persons">Number of persons</label>
                        <b-form-input v-model="noOfPersons" name="no_of_persons" :type="'text'"></b-form-input>
                    </b-col>
                </b-row><br>
                <b-row>
                    <b-button block variant="primary" @click="book()">Book Room</b-button>
                </b-row>
            </b-col>
            
        </b-row>
    </b-container>
</div>
</template>


<script>
import {mapGetters} from 'vuex'
import moment from 'moment'

export default {
    computed: {
        ...mapGetters('payment', {
            showPayment: 'showPayment',
        }),
        finalCheckInDate(dateString) {
            return moment(dateString).format("YYYY-MM-DD")
        },
        finalCheckOutDate(dateString) {
            return moment(dateString).format("YYYY-MM-DD")
        }
    },
    data () {
        return {
            checkInDate: moment(Date.now()).format("YYYY-MM-DD"),
            checkOutDate: moment(Date.now()).add(1, 'days').format("YYYY-MM-DD"),
            noOfPersons:1,
            noOfRooms: 1,
            image_url: '',
            room_name: '',
            price: 0,
            type: 'date'
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
            if (localStorage.getItem('token')) {
                let totalToPay = this.price * this.noOfRooms;
                this.showPaystack(totalToPay);
                return
            }
            this.showLogin();
        },

        showLogin() {
            this.$router.push('/userlogin');
        },
        
        showPaystack(totalToPay) {
            let vinst = this;
            var handler = PaystackPop.setup({
                key: 'pk_test_7dfcdc2c0d8e91d525e52ee606b01e707b805b09',
                email: 'customer@email.com',
                amount: parseInt(totalToPay * 100),
                currency: "NGN",
                //ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
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
                    console.log("check in date is ", vinst.checkInDate)
                    console.log("final check in date is ", vinst.finalCheckInDate)
                    console.log("check out date is ", vinst.checkOutDate)
                    console.log("final check out date is ", vinst.finalCheckOutDate)
                    console.log("this.axios is ", this.axios);
                    console.log("vinst.axios is ", vinst.axios);

                    vinst.axios.post('/api/reservation', {
                        customer_id: localStorage.getItem('customerID'),
                        room_type_id: vinst.$route.params.id,
                        no_of_rooms: vinst.noOfRooms,
                        no_of_persons: vinst.noOfPersons,
                        amount: totalToPay,
                        transaction_ref: response.reference,
                        check_in_date: vinst.finalCheckInDate,
                        check_out_date: vinst.finalCheckOutDate,
                    })
                    .then(response=>{
                        console.log("response is ", response);
                        if (response.status==200) {
                            vinst.$router.push('/bookings');
                        }
                    })
                    .catch(error=>{
                        console.log("error is ", error);
                    })
                },
                onClose: function(){
                    
                }
            });
            handler.openIframe();
        }
    },
    //------------  LIFE CYCLE HERE -------------
    created() {
        console.log(moment(Date.now()).format("YYYY-MM-DD"));
        console.log(this.$route)
        let id = this.$route.params.id;
        console.log(`id is ${id}`)
        this.axios.get(`/api/rooms/${id}`)
            .then(response=>{
                this.image_url = `images/${response.data.images[0].image_name}`;
                this.room_name = response.data.name;
                this.price = response.data.price;
            })
            .catch(error=>{

            });
    },
    mounted () {
        console.log("mounted");
        console.log("show payment is ", this.showPayment);
        if (this.showPayment) {
            let totalToPay = this.price * this.noOfRooms;
            this.showPaystack(totalToPay);
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

