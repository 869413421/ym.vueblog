import axios from '../http';

export function createGood(topic_id) {
    return axios({
        url: 'topic/'+topic_id+'/good',
        method: 'get',
    })
}

export function deleteGood(topic_id) {
    return axios({
        url: 'topic/'+topic_id+'/good',
        method: 'delete',
    })
}
