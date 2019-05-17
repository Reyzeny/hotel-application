import Vue from 'vue'
import VueRouter from 'vue-router'
import MainPage from '../components/MainPage'
import ExampleComponent from '../components/ExampleComponent'
import RoomListingComponent from '../components/RoomListingComponent'

Vue.use(VueRouter)

const routes = [
    {
        path: '/vue',
        component: MainPage
    },
    {
        path: '/vue/rooms',
        component: RoomListingComponent
    }
]

export default new VueRouter({
    mode: 'history',
    routes
})