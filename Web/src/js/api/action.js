import axios from '../http';

export function getAction() {
    return axios({
        url: 'user/action',
        method: 'get',
    })
}
