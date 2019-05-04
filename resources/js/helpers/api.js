import axios from 'axios'

axios.interceptors.request.use(config => {
    NProgress.start();

    return config;
})

axios.interceptors.response.use(response => {
    NProgress.done();
    
    return response;
})

const concatUrl = function (url) {
    const baseUrl = window.Laravel.url + '/api/'

    return baseUrl.concat(url)
}

export function get(url) {
    return axios({
        method: 'GET',
        url: concatUrl(url)
    })
}

export function post(url, payload = '') {
    return axios({
        method: 'POST',
        url: concatUrl(url),
        data: payload
    })
}

export function patch(url, payload = '') {
    return axios({
        method: 'PATCH',
        url: concatUrl(url),
        data: payload
    })
}

export function put(url, payload = '') {
    return axios({
        method: 'PUT',
        url: concatUrl(url),
        data: payload
    })
}

export function del(url, payload = '') {
    return axios({
        method: 'DELETE',
        url: concatUrl(url),
        data: payload
    })
}
