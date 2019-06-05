require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import router from './router/index.js'
import store from './store'
import VueI18n from 'vue-i18n'
import messages from './locale'
import VeeValidate, { Validator } from 'vee-validate'
import vi from 'vee-validate/dist/locale/vi'
import en from 'vee-validate/dist/locale/en'
import * as VueGoogleMaps from 'vue2-google-maps'
const HelloJs = require('hellojs/dist/hello.all.min.js');
const VueHello = require('vue-hellojs');

HelloJs.init({
    google: process.env.MIX_GOOGLE_CLIENT_ID,
    facebook: process.env.MIX_FACEBOOK_CLIENT_ID
}, {
    redirect_uri: '/'
});

Vue.use(VueHello, HelloJs);

Vue.use(VueI18n);
Vue.component('master-component', require('./components/layout/Master.vue').default);
Vue.use(VeeValidate, {
    locale: 'vi',
    dictionary: {
        vi : {
            messages: vi.messages,
        },
        en : {
            messages: en.messages,
        }
    }
});

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBXTnVjJyaI2nsAVV9pBpW2pF5YfQn76JY',
        libraries: 'places'
    },
})

let locale = localStorage.getItem('locale');
Validator.localize('vi');

const i18n = new VueI18n({
    locale,
    fallbackLocale: window.Laravel.fallbackLocale,
    messages
});

const app = new Vue({
    el: '#app',
    router,
    store,
    i18n
});
