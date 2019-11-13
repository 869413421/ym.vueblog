import axios from '../http';

export function getAction(page,page_size) {
    return axios({
        url: 'user/action',
        method: 'get',
        params:{
            page:page,
            page_size:page_size
        }
    })
}
