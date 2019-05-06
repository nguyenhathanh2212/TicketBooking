import { post, get, patch } from '../../../helpers/api'
import * as types from './mutation-types'

export const setRoutes = ({ commit }, params) => {
    var path = 'route?';
    params.size = params.size ? params.size : 9;
    params.page = params.page ? params.page : 1;

    for (let param in params) {
        path += `${param}=${params[param]}&`;
    }

    return new Promise((resolve, reject) => {
        get(path)
            .then(response => {
                commit(types.SET_ROUTES, response.data);
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export default {
    setRoutes
}
