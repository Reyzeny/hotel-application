<template>
    <div>
        <header-component/>
        
        <b-container>
            <h2 class="text-center" style="margin-bottom: 50px;">Rooms Available</h2>
            <b-row v-for="room in rooms" :key="room.index" style="margin-top: 30px;">
                <b-card no-body class="overflow-hidden" style="width: 100%; height: 50vh;">
                    <b-row no-gutters>
                    <b-col md="6">
                        <b-card-img :src="`images/${room.images[0].image_name}`" class="rounded-0" style="height: 50vh"></b-card-img>
                    </b-col>
                    <b-col md="6">
                        <b-card-body :title="`${room.name}`">
                        <b-card-text>
                            <p>=N= {{room.price}}</p><br>
                            <p>Features: {{room.features}}</p><br>
                            <router-link class="btn btn-primary" :to="`/rooms/${room.id}`">Book Room</router-link>
                        </b-card-text>
                        </b-card-body>
                    </b-col>
                    </b-row>
                </b-card>
                <!-- <b-col md="7" class="content">
                    <img :src="`images/${room.images[0].image_name}`"/>
                    <div class="subcontent">
                        <h3>{{ room.name }}</h3>
                        <p>{{ room.features }}</p>
                        <b-button class="booking-btn" variant="outline-primary">Book</b-button>
                    </div>
                </b-col>
                <b-col md="5"></b-col> -->
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

.listing-image {
    width: 50px;
    height: 50px;
}
</style>

