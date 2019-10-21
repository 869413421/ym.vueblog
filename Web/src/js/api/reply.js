import axios from '../http'

export function createReply(topic_id, comment_id, user_id, content) {
    console.log(user_id);
    return axios({
        url: "topic/" + topic_id + '/comment/' + comment_id + "/reply",
        method: 'post',
        data: {
            content: content,
            reply_user_id: user_id,
        }
    })
} 