import * as types from './mutation-types'

export default {
    [types.SET_ALL_PROVINCIALS](state, data) {
        state.allProvincials = data.allProvincials;
    },
}