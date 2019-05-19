import Vue from 'vue'
import VueRouter from 'vue-router'
import MainPage from '../components/MainPage'
import ExampleComponent from '../components/ExampleComponent'
import RoomListingComponent from '../components/RoomListingComponent'
import RoomInfoComponent from '../components/RoomInfo'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: MainPage
    },
    {
        path: '/rooms',
        component: RoomListingComponent
    },
    {
        path: '/rooms/:id',
        component: RoomInfoComponent
    }
]

export default new VueRouter({
    
    routes
})