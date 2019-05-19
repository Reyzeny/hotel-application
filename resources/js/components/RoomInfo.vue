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


export default {
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
        }
    }   
}
</script>


<style>
.image {
    height: 100%;
    width: 100%;
}
</style>

