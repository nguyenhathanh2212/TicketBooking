import * as types from './mutation-types'
import { post, get, patch } from '../../../helpers/api'

export const checkAuthenticated = ({ commit }) => {
    commit(types.CHECK_AUTHENTICATED);
};

export const login = ({ commit }, data) => {
    return new Promise((resolve, reject) => {
        post('auth/login', data)
            .then(response => {
                commit(types.LOGIN, response.data);
                commit(types.SET_USER, response.data.data.user);
                resolve(response.status);
            })
            .catch(error => {
                reject(error);
            });
    })
}

export const loginSocial = ({ commit }, data) => {
    return new Promise((resolve, reject) => {
        post('auth/login_social', data)
            .then(response => {
                commit(types.LOGIN, response.data);
                commit(types.SET_USER, response.data.data.user);
                resolve(response.status);
            })
            .catch(error => {
                reject(error);
            });
    })
}

export const setUser = ({ commit }) => {
    return new Promise((resolve, reject) => {
        get('auth/user')
            .then(response => {
                commit(types.SET_USER, response.data.data.user);
                resolve(response.status);
            })
            .catch(error => {
                reject(error);
            });
    })
}

export const logout = ({ commit }) => {
    commit(types.LOGOUT);
};

export const register = ({ commit }, data) => {
    return new Promise((resolve, reject) => {
        post('auth/register', data)
            .then(response => {
                commit(types.LOGIN, response.data);
                commit(types.SET_USER, response.data.data.user);
                resolve(response.status);
            })
            .catch(error => {
                reject(error);
            });
    })
}

export const update = ({ commit }, data) => {
    return new Promise((resolve, reject) => {
        axios.defaults.headers.common['Content-Type'] = 'multipart/form-data';
        var formData = new FormData(data);
        
        $.each(data, function(key, value) {
            formData.append(key, value);
        });
        
        post('auth/update', formData)
            .then(response => {
                commit(types.SET_USER, response.data.data.user);
                resolve(response.status);
            })
            .catch(error => {
                reject(error);
            });
    })
}

export default {
    checkAuthenticated,
    login,
    loginSocial,
    setUser,
    logout,
    register,
    update
}