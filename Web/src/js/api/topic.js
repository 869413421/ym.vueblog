import axios from '../http'

export function createTopic(type, data) {
    return axios({
        url: 'topic',
        method: type,
        data: data
    })
}

export function getTopic(id) {
    return axios({
        url:'topic/'+id,
        method:'get',
    });
}