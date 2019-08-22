import axios from 'axios';
import store from '../vuex/store.js';
import Element from 'element-ui';
import { Loading } from 'element-ui';

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
        // config['headers']['Authorization'] = AUTH_TOKEN
    }
    return config;
}, function (error) {
    // 对请求错误做些什么
    return Promise.reject(error);
});
// 添加响应拦截器  就是对数据做些什么
Axios.interceptors.response.use(function (response) {
    // 对响应数据做点什么
    return response;
}, function (error) {
    // 对响应错误做点什么
    return Promise.reject(error);
});
// 在传递给 then/catch 前，允许修改响应数据 这里是 判断code的值 来进行操作
Axios.defaults.transformResponse = [function (data) {

    Loading.service({ fullscreen: true, text: '加载中' }).close();
    // try {
    var res = JSON.parse(data);
    if (res.status_code == 401) {
        console.log(store);
        store.commit("LoginStatus", null);
        Element.Message.error('请重新登陆');
        return res;
    }
    return res;
    // } catch (e) {
    //     Element.Message.error(e.Message);
    // }
}];
// 将 Axios 实例添加到Vue的原型对象上
export default {
    install(Vue) {
        Object.defineProperty(Vue.prototype, 'axios', {
            value: Axios
        })
    }
}