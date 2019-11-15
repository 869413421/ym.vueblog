import axios from '../http';

export function getUserIofo(query) {
    return axios({
        url: 'user',
        method: 'get',
        params: query
    })
}

export function getUserIofoById(id) {
    return axios({
        url: 'user/'+id,
        method: 'get',
    })
}

export function getUserTopic(user_id, page, page_size,type) {
    return axios({
        url: 'user/' + user_id + '/'+type,
        method: 'get',
        params: {
            page: page,
            page_size: page_size
        }
    })
}

export function getUserAction(user_id, page, page_size,type) {
    return axios({
        url: 'user/' + user_id + '/action',
        method: 'get',
        params: {
            page: page,
            page_size: page_size
        }
    })
}
