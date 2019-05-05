import * as types from './mutation-types'

export default {
    [types.SET_ALL_PROVINCIALS](state, data) {
        state.allProvincials = data.allProvincials;
    },
    
    [types.SET_POPULAR_PROVINCIALS](state, data) {
        state.popularProvincials = data.popularProvincials;
    }
}