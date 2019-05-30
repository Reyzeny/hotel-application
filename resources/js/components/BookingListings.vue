<template>
<div>
    <header-component/>
    <b-container>
        <b-row>
            <h1 style="color: blue;">Your Bookings</h1>
        </b-row>
        <b-row  style="margin-top: 50px;">
            <h2>Recent Bookings</h2>
        </b-row>
        <b-row>
            <b-col sm="2">
                Booking ID
            </b-col>
            <b-col sm="3">
                Room
            </b-col>
            <b-col sm="2">
                Amount
            </b-col>
            <b-col sm="3">
                
            </b-col>
            <b-col sm="2">
               
            </b-col>
        </b-row>
        <b-row>
            <b-card v-for="recent in recent_bookings" :key="recent.id" style="margin-top: 20px; width: 100%;">
                <b-row>
                    <b-col sm="2">
                        {{recent.id|getIdFormatted}}
                    </b-col>
                    <b-col sm="3">
                        {{recent.room_type.name}}({{recent.no_of_rooms}})
                    </b-col>
                    <b-col sm="2">
                        =N={{recent.amount}}
                    </b-col>
                    <b-col sm="3">
                        {{recent.created_at}}
                    </b-col>
                    <b-col sm="2">
                        <b-button @click="printPDF(recent.id, recent.customer.first_name)">print receipt</b-button>
                    </b-col>
                </b-row>
                <receipt-component 
                class="receipt"
                :id="`receipt${recent.id}`" 
                :bookingID="`${recent.id}`"
                :first_name="`${recent.customer.first_name}`"
                :last_name="`${recent.customer.last_name}`"
                :room_type="`${recent.room_type.name}`"
                :no_of_rooms="`${recent.no_of_rooms}`"
                :amount="`${recent.amount}`"
                :check_in_date="`${recent.check_in_date}`"
                :check_out_date="`${recent.check_out_date}`"
                :transaction_ref="`${recent.transaction_ref}`"/>
            </b-card>
        </b-row>
        <b-row style="margin-top: 100px;">
            <h2>Past bookings</h2>
        </b-row>
        <b-row>
            <b-col sm="2">
                Booking ID
            </b-col>
            <b-col sm="3">
                Room
            </b-col>
            <b-col sm="2">
                Amount
            </b-col>
            <b-col sm="3">
                
            </b-col>
            <b-col sm="2">
               
            </b-col>
        </b-row>
        <b-row>
            <b-card v-for="past in past_bookings" :key="past.id" style="margin-top: 10px; width: 100%;  margin-bottom: 10px;">
                <b-row>
                    <b-col sm="2">
                        {{past.id|getIdFormatted}}
                    </b-col>
                    <b-col sm="3">
                        {{past.room_type.name}}({{past.no_of_rooms}})
                    </b-col>
                    <b-col sm="2">
                        =N={{past.amount}}
                    </b-col>
                    <b-col sm="3">
                        {{past.created_at}}
                    </b-col>
                    <b-col sm="2">
                        <b-button @click="printPDF(past.id, past.customer.first_name)">print receipt</b-button>
                    </b-col>
                </b-row>
                <receipt-component 
                class="receipt"
                :id="`receipt${past.id}`" 
                :bookingID="`${getIdFormatted(past.id)}`"
                :first_name="`${past.customer.first_name}`"
                :last_name="`${past.customer.last_name}`"
                :room_type="`${past.room_type.name}`"
                :no_of_rooms="`${past.no_of_rooms}`"
                :amount="`${past.amount}`"
                :check_in_date="`${past.check_in_date}`"
                :check_out_date="`${past.check_out_date}`"
                :transaction_ref="`${past.transaction_ref}`"/>
            </b-card>
        </b-row>
    </b-container>
</div>
</template>
<script>
import jspdf from 'jspdf'
export default {
    computed: {
        getFormatted(id) {
            return this.getIdFormatted(id);
        }
    },
    data () {
        return {
            recent_bookings: [],
            past_bookings: [],
        }
    },
    methods: {
        printPDF(bookingId, first_name) {
            console.log(this);
            const pdf = jspdf();
            pdf.fromHTML($(`#receipt${bookingId}`).html(), 15, 15, {
                'width': 170,
                'elementHandlers': pdf.specialElementHandlers
            });
            pdf.save(`${first_name}-receipt.pdf`);
        },

        getIdFormatted(id) {
            console.log("id is ", id);
            id = id.toString();
            console.log("id after conv is ", id);
            let id_count = id.length;
            let zero_to_add = 6 - id_count;

            return '0'.repeat(zero_to_add) + id;
        }
    },

    created() {
        
        this.axios.get(`/api/bookings/${localStorage.getItem('customerID')}`).then(response=>{
            console.log("response is ", response);
            this.recent_bookings = response.data.recent;
            this.past_bookings = response.data.past;
        })
        .catch(error=>{
            console.log("error is ", error);
        })
    },
    filters: {
        getIdFormatted(id) {
            console.log("id is ", id);
            id = id.toString();
            console.log("id after conv is ", id);
            let id_count = id.length;
            let zero_to_add = 6 - id_count;

            return '0'.repeat(zero_to_add) + id;
        }
    }
}
</script>
<style>
*{
    text-align: center;
}
.header {
    color: blue;
}
.receipt {
    display: none;
}
.nav-text-color {
    color: blue !important;
}
</style>

