import * as types from './mutation-types';

export default {
    [types.SET_AUTH_BOOKINGS](state, data) {
        state.authBookings = data.tickets;
    },
 
    [types.SET_TICKET](state, data) {
        state.ticket = data.ticket;
    },
}
