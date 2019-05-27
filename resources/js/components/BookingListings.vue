<template>
<div>
    <b-container id="content">
        <b-row>
            <h1 style="color: blue;">Your Bookings</h1>
        </b-row>
        <b-row v-for="booking in bookings" :key="booking.index">
            <b-col md="3">
                {{ booking.noOfRoom }} {{ booking.room_type }}
            </b-col>
            <b-col md="3">
                {{booking.price}}
            </b-col>
            <b-col md="3">
                {{booking.date}}
            </b-col>
            <b-col md="3">
                <b-button variant="primary">Print Receipt</b-button>
            </b-col>
            <div :id="`receipt${booking.id}`">
                <h1>Booking ID: </h1>
                date

                name
                room_type
                room number(s)
                amount

            </div>
        </b-row>
    </b-container>

    
</div>
</template>
<script>
import jspdf from 'jspdf'
export default {
    methods: {
        printPDF(bookingId) {
            console.log(this);
            const pdf = jspdf();
            pdf.fromHTML($(`#receipt${bookingId}`).html(), 15, 15, {
                'width': 170,
                    'elementHandlers': pdf.specialElementHandlers
            });
            pdf.save('sample-file.pdf');
        }
    }
}
</script>
<style>
#content {
    display: none;
}
.header {
    color: blue;
}
</style>

