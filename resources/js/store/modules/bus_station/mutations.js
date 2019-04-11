import * as types from './mutation-types'

export default {
    [types.SET_BUS_STATIONS](state, data) {
        state.busStations = data.busStations;
    },
}