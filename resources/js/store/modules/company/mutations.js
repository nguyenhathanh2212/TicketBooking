import * as types from './mutation-types';

export default {
    [types.SET_COMPANIES](state, data) {
        state.companies = data.companies;
    },

    [types.SET_COMPANY](state, data) {
        state.company = data.company;
    },

    [types.SET_RATINGS](state, data) {
        state.ratings = data.ratings;
    }
}
