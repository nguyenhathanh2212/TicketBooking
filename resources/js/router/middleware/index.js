import store from '../../store'
import Vue from 'vue'
import router from '../../router/index.js'


export const isLoggedIn = (to, from, next) => {
    var auth = store.state.auth;

    Vue.nextTick(function () {
        if (auth.authenticated) {
            next();
        } else {
            router.push({ name: '404' });
        }
    });
}

export default {
    isLoggedIn
}