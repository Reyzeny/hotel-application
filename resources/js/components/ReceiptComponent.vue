<template>
<div>
    <div>
        <h1>Owu Crown Hotel</h1>
    </div>
    <div>
        <h2>Receipt</h2>
    </div>
    <div>
        Booking ID: #{{bookingID}}
    </div><br>
    <div>
        Name: {{first_name}} {{last_name}}
    </div><br>
    <div>
        Room Type: {{room_type}} ({{no_of_rooms}})
    </div><br>
    <div>
        Amount: =N= {{amount}}
    </div><br>
    <div>
        Check in date: {{check_in_date}}
    </div><br>
    <div>
        Check out date: {{check_out_date}}
    </div><br>
    <div>
        Transaction reference: {{transaction_ref}}
    </div><br>
</div>
</template>
<script>
export default {
    props: {
        bookingID: String,
        first_name: String,
        last_name: String,
        room_type: String,
        no_of_rooms: String,
        amount: String,
        check_in_date: String,
        check_out_date: String,
        transaction_ref: String,
    }
}
</script>

