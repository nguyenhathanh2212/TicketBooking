import { post, get, patch } from '../../../helpers/api'
import * as types from './mutation-types'

export const setBusRoutes = ({ commit }, params) => {
    var path = 'bus-route?';
    params.size = params.size ? params.size : 9;
    params.page = params.page ? params.page : 1;

    for (let param in params) {
        path += `${param}=${params[param]}&`;
    }
    
    return new Promise((resolve, reject) => {
        get(path)
            .then(response => {
                commit(types.SET_BUS_ROUTES, response.data);
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export const setBusRoute = ({ commit}, busRouteId) => {
    return new Promise((resolve, reject) => {
        get(`bus-route/${busRouteId}`)
            .then(response => {
                commit(types.SET_BUS_ROUTE, response.data);
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export default {
    setBusRoutes,
    setBusRoute
}
