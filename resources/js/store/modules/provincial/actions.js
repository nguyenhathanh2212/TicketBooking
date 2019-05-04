import { post, get, patch } from '../../../helpers/api'
import * as types from './mutation-types'

export const setAllProvincials = ({ commit }) => {
    var path = 'provincial';
    return new Promise((resolve, reject) => {
        get(path)
            .then(response => {
                commit(types.SET_ALL_PROVINCIALS, response.data);
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export default {
    setAllProvincials
}
