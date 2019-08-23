import axios from '../http';

export function getUserIofo(query) {
    return axios({
        url: 'user',
        method: 'get',
        params: query
    })
}
