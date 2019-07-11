// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './vuex/store'
import Axios from 'axios'
import Element from 'element-ui'
import Base from './js/base'
import 'element-ui/lib/theme-chalk/index.css'

Vue.config.productionTip = false
Axios.defaults.baseURL = 'http://ymbbs.com/api/'
Axios.defaults.withCredentials = true;
Vue.prototype.axios=Axios
Vue.use(Element)
Vue.use(Base)

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
