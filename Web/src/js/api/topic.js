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
        url: 'topic/' + id+'?include=user,category',
        method: 'get',
    });
}

export function updateTopic(id, data) {
    return axios({
        url: 'topic/' + id,
        method: 'patch',
        data:data
    });
}

export function deleteTopic(id)
{
    return axios({
        url: 'topic/' + id,
        method: 'delete'
    })
}