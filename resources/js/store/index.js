import Vue from 'vue'
import Vuex from 'vuex'
import company from './modules/company'
import auth from './modules/auth'
import bus_route from './modules/bus_route'
import bus_station from './modules/bus_station'
import provincial from './modules/provincial'
import route from './modules/route'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        company,
        auth,
        bus_route,
        bus_station,
        provincial,
        route
    }
});
