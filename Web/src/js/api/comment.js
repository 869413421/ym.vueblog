import axios from '../http'

export function getCommentList(id) {
    return axios({
        url:'comment/'+id,
        method:'get',
    });
}