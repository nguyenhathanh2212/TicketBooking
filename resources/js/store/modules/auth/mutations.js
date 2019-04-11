import * as types from './mutation-types'
import axios from 'axios'

export default {
    [types.CHECK_AUTHENTICATED](state) {
        state.authenticated = !! localStorage.getItem('access_token');
        state.user = JSON.parse(localStorage.getItem('user'));
        axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('access_token')}`
    },

    [types.LOGIN](state, data) {
        let accessToken = data.data.access_token;
        state.authenticated = true;
        localStorage.setItem('access_token', accessToken);
        axios.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
    },

    [types.LOGOUT](state) {
        state.authenticated = false;
        state.user = {};
        localStorage.removeItem('access_token');
        localStorage.removeItem('user');
        axios.defaults.headers.common['Authorization'];
    },

    [types.SET_USER](state, user) {
        state.user = user;
        localStorage.setItem('user', JSON.stringify(user));
    }
}