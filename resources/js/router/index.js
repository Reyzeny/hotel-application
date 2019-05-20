import Vue from 'vue'
import VueRouter from 'vue-router'
import MainPage from '../components/MainPage'
import ExampleComponent from '../components/ExampleComponent'
import RoomListingComponent from '../components/RoomListingComponent'
import RoomInfoComponent from '../components/RoomInfo'
import Login from '../components/Login'

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
    }
]

export default new VueRouter({
    
    routes
})