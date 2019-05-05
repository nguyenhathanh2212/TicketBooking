import { post, get, patch } from '../../../helpers/api'
import * as types from './mutation-types'

export const setBusStations = ({ commit }, params) => {
    var path = 'bus-station?';
    params.size = params.size ? params.size : 9;
    params.page = params.page ? params.page : 1;

    for (let param in params) {
        path += `${param}=${params[param]}&`;
    }

    return new Promise((resolve, reject) => {
        get(path)
            .then(response => {
                commit(types.SET_BUS_STATIONS, response.data);
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export default {
    setBusStations
}
