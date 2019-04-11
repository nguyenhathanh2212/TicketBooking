require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import router from './router/index.js'
import store from './store'
import VueI18n from 'vue-i18n'
import messages from './locale'
import VeeValidate, { Validator } from 'vee-validate'
import vi from 'vee-validate/dist/locale/vi'

Vue.use(VueI18n);
Vue.component('master-component', require('./components/layout/Master.vue').default);
Vue.use(VeeValidate, {
    locale: 'vi',
    dictionary: {
        vi : {
            messages: vi.messages,
        }
    }
});

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
