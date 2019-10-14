import axios from 'axios';
import store from '../vuex/store.js';
import { MessageBox, Message } from 'element-ui'
import { Loading } from 'element-ui';
import router from '../router';

// 创建 axios 实例

export const Axios = axios.create({
    baseURL: 'http://ymbbs.com/api/',  //接口名称
    // baseURL: 'http://127.0.0.1:9006/api/',
    timeout: 5000,  //请求接口的时间
    withCredentials: true
})

// 添加请求拦截器
Axios.interceptors.request.use(function (config) {
    // console.log(config)
    // 在发送请求之前做些什么 设置token 判断有没有token
    Loading.service({ fullscreen: true, text: '加载中' })
    if (store.state.token) {
        config.headers.Authorization = 'Bearer ' + store.state.token;
    }
    return config;
}, function (error) {
    // 对请求错误做些什么
    return Promise.reject(error);
});
// 添加响应拦截器  就是对数据做些什么
Axios.interceptors.response.use(
    response => {
        const res = response.data;
        const code = response.status;
        let successCode = [200, 201, 203];

        if (successCode.indexOf(code) == -1) {
            Loading.service({ fullscreen: true, text: '加载中' }).close();
            Message({
                message: res.message || 'Error',
                type: 'error',
                duration: 5 * 1000
            })
            return Promise.reject(new Error(res.message || 'Error'))
        }
        else {
            Loading.service({ fullscreen: true, text: '加载中' }).close();
            return response
        }
    },
    error => {
        console.log(error) // for debug
        let code = error.response.status;

        if (code === 401) {
            // to re-login
            store.dispatch("DispachToken", '');
            store.dispatch("DispachUser", '');
            MessageBox.confirm('你的登陆信息已经过期', '是否重新登陆？', {
                confirmButtonText: '前往登陆',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                router.push({
                    path: '/login'
                });
            })
        }
        if (code === 404) {
            // to re-login
            Message.error('系统繁忙');
        }
        if (code === 500) {
            Message.error('系统繁忙');
        }
        if (code === 422) {
            // to re-login
            Message.error('验证错误');
        }
        Loading.service({ fullscreen: true, text: '加载中' }).close();
        return Promise.reject(error)
    }
);
// 在传递给 then/catch 前，允许修改响应数据 这里是 判断code的值 来进行操作
// Axios.defaults.transformResponse = [function (data) {

//     Loading.service({ fullscreen: true, text: '加载中' }).close();
//     try {
//         var res = JSON.parse(data);
//         if (res.status_code == 401) {
//             console.log(store);
//             store.commit("LoginStatus", null);
//             Element.Message.error('请重新登陆');
//             return res;
//         }
//         return res;
//     } catch (e) {
//         Element.Message.error(e.Message);
//     }
// }];

export default Axios;