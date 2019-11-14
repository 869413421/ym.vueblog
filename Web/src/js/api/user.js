import axios from '../http';

export function getUserIofo(query) {
    return axios({
        url: 'user',
        method: 'get',
        params: query
    })
}

export function getUserTopic(user_id, page, page_size) {
    return axios({
        url: 'user/' + user_id + '/topic',
        method: 'get',
        params: {
            page: page,
            page_size: page_size
        }
    })
}
