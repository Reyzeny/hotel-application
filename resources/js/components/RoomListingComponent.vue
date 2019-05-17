<template>
    <b-container>
        <header-component/>
        <b-row>
            <b-col></b-col>
            <b-col>
                <div>

                </div>
                <div v-for="room in rooms" :key="room.index">
                    <img :src="room.image"/>
                    <h4>{{room.name}}</h4>
                    <p>{{room.features}}</p>
                    <p>{{room.price}}</p>
                </div>
            </b-col>
            <b-col></b-col>
        </b-row>
    </b-container>
</template>

<script>
export default {
    data () {
        return {
            progressBarVisible: false,
            rooms: []
        }
    },
    created() {
        this.progressBarVisible = true
    },
    methods: {
        
    }
}
</script>

