import Vue from 'vue'
import VueRouter from 'vue-router'
import MainPage from '../components/MainPage'
import ExampleComponent from '../components/ExampleComponent'
import RoomListingComponent from '../components/RoomListingComponent'
import RoomInfoComponent from '../components/RoomInfo'
import Login from '../components/Login'
import BookingListings from '../components/BookingListings'
import Signup from '../components/Signup'

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
    },
    {
        path: '/userlogin',
        component: Login
    },
    {
        path: '/usersignup',
        component: Signup
    },
    {
        path: '/bookings',
        component: BookingListings
    }
]

export default new VueRouter({
    
    routes
})