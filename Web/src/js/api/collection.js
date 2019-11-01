import axios from '../http';

export function createCollection(topic_id) {
    return axios({
        url: 'topic/'+topic_id+'/collection',
        method: 'get',
    })
}

export function deleteCollection(topic_id) {
    return axios({
        url: 'topic/'+topic_id+'/collection',
        method: 'delete',
    })
}
