<template>
    <div>
        <header-component/>
        <b-container>
            <b-row v-for="room in rooms" :key="room.index">
                <b-col md="7" class="content">
                    <img :src="`images/${room.images[0].image_name}`"/>
                    <div class="subcontent">
                        <h3>{{ room.name }}</h3>
                        <p>{{ room.features }}</p>
                        <b-button class="booking-btn" variant="outline-primary">Add To Bookings</b-button>
                    </div>
                </b-col>
                <b-col md="5"></b-col>
            </b-row>
        </b-container>
    </div>
</template>
<script>
export default {
    data () {
        return {
            rooms: [],
        }
    },
    created () {
        this.axios.get('/api/rooms')
            .then(response=> {
                console.log("response is ", response);
                this.rooms = response.data;
            })
            .catch(error=> {
                console.log("error is ", error);
            })
    }       
}
</script>

<style>
.content {
    display: flex;
    flex-direction: row;
    margin-top: 50px;
}
.subcontent {
    width: 100%;
    display: flex;
    flex-direction: column;
    text-align: center;
    margin-left: 50px;
}
.content>img {
    width: 150px;
    height: 150px;
    
}
.booking-btn {
    
}
.side {
    background: url('/images/bg1.png') no-repeat center fixed;
    background-size: cover;
}
</style>

