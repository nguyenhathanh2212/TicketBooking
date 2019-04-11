import { post, get, patch } from '../../../helpers/api'
import * as types from './mutation-types'

export const setCompanies = ({ commit }, params) => {
    var path = 'company?';

    for (let param in params) {
        path += `${param}=${params[param]}&`;
    }

    return new Promise((resolve, reject) => {
        get(path)
            .then(response => {
                commit(types.SET_COMPANIES, response.data);
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export const setCompany = ({ commit }, companyId) => {
    return new Promise((resolve, reject) => {
         get(`company/${companyId}`)
            .then(response => {
                commit(types.SET_COMPANY, response.data);
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export const setRatings = ({ commit }, params) => {
    var path = `company/${params.company_id}/rating?`;

    for (let param in params.data) {
        path += `${param}=${params.data[param]}&`;
    }

    return new Promise((resolve, reject) => {
        get(path)
            .then(response => {
                commit(types.SET_RATINGS, response.data);

                console.log(response.data);
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export const rate = ({ commit }, params) => {
    return new Promise((resolve, reject) => {
        post(`company/${params.company_id}/rating`, params.data)
            .then(response => {
                resolve(response.data.code);
            })
            .catch(error => {
                reject(error);
            })
    })
}

export default {
    setCompanies,
    setCompany,
    setRatings,
    rate
}
