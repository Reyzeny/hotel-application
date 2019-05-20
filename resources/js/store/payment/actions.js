export default {
    ASYNC_SHOW_PAYMENT({commit}, params) {
        console.log("params is ", params)
        commit('SHOW_PAYMENT', params);
    }
}