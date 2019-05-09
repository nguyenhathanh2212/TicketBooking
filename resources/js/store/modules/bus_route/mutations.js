import * as types from './mutation-types';

export default {
    [types.SET_BUS_ROUTES](state, data) {
        state.busRoutes = data.busRoutes;
    },

    [types.SET_BUS_ROUTE](state, data) {
        state.busRoute = data.busRoute;
    },
    
    [types.SET_RATINGS](state, data) {
        state.ratings = data.ratings;
    }
}
