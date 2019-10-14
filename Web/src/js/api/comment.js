import axios from '../http'

export function getCommentList(id) {
    return axios({
        url: 'topic/' + id+'/comment?include=user,replyuser,reply',
        method: 'get',
    });
}

export function postComment(id, content) {
    return axios({
        url: 'comment',
        method: 'post',
        data: {
            id: id,
            content: content
        }
    });
}