import { post, get, patch } from '../../../helpers/api'
import * as types from './mutation-types'

export const createTicket = ({ commit }, params) => {
    return new Promise((resolve, reject) => {
        post(`ticket`, params)
            .then(response => {
                resolve(response);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export const setAuthBookings = ({ commit }, params) => {
    var path = 'my-bookings?';
    params.size = params.size ? params.size : 9;
    params.page = params.page ? params.page : 1;

    for (let param in params) {
        path += `${param}=${params[param]}&`;
    }
    
    return new Promise((resolve, reject) => {
        get(path)
            .then(response => {
                commit(types.SET_AUTH_BOOKINGS, response.data);
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export const setTicket = ({ commit }, ticketId) => {
    return new Promise((resolve, reject) => {
         get(`ticket/${ticketId}`)
            .then(response => {
                commit(types.SET_TICKET, response.data);
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export const cancelTicket = ({ commit }, ticketId) => {
    return new Promise((resolve, reject) => {
        post(`cancel-ticket/${ticketId}`)
            .then(response => {
                resolve(response);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export default {
    createTicket,
    setAuthBookings,
    setTicket,
    cancelTicket
}
