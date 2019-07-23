import axios from 'axios';
import store from '../vuex/store.js';
// let AUTH_TOKEN = (function() {
// 	return sessionStorage.getItem("token");
// })();
// 创建 axios 实例

export const Axios = axios.create({
    baseURL: 'http://ymbbs.com/api/',  //接口名称
    timeout: 5000,  //请求接口的时间
    withCredentials: true
})
// 添加请求拦截器
Axios.interceptors.request.use(function (config) {
    // console.log(config)
    // 在发送请求之前做些什么 设置token 判断有没有token
    if (store.state.token) {
        // console.log(store.state.token)
        config.headers.token = `${store.state.token}`;
        // config['headers']['Authorization'] = AUTH_TOKEN
    }
    return config;
}, function (error) {
    // 对请求错误做些什么
    return Promise.reject(error);
});
// 添加响应拦截器  就是对数据做些什么
Axios.interceptors.response.use(function (response) {
    console.log(response.data)
    // 对响应数据做点什么
    return response;
}, function (error) {
    // 对响应错误做点什么
    return Promise.reject(error);
});
// // 在传递给 then/catch 前，允许修改响应数据 这里是 判断code的值 来进行操作
// Axios.defaults.transformResponse = [function (data) {
//     return data;
//     try {
//         var res = $.parseJSON(data);
//         // console.log(res.code)
//         if (res.code == -1000) {
//             sessionStorage.clear();
//             window.location.href = "/"
//         }
//         return res;
//     } catch (e) {
//         // 		return {
//         // 			result: null,
//         // 			error: {
//         // 				code: -1,
//         // 				msg: "network error",
//         // 			}
//         // 		};
//     }
// }];
// 将 Axios 实例添加到Vue的原型对象上
export default {
    install(Vue) {
        Object.defineProperty(Vue.prototype, 'axios', {
            value: Axios
        })
    }
}