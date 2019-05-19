import Vue from 'vue'
import Vuex from 'vuex'
import user from './user'
import payment from './payment'

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        user,
        payment,
    }
})