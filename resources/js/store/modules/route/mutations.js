import * as types from './mutation-types';

export default {
    [types.SET_ROUTES](state, data) {
        state.routes = data.routes;
    }
}
