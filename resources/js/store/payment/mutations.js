export default {
    SHOW_PAYMENT: (state, payload) => {
        console.log(`in mutation, payload is ${payload} and payload.showPayment is ${payload.showPayment}`);
        state.showPayment = payload.showPayment;
        console.log(`finally, state.showpayment is ${state.showPayment}`)
    }
}