// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './vuex/store'
import Element from 'element-ui'
import Base from './js/base'
import Http from './js/http'
import 'element-ui/lib/theme-chalk/index.css'
import mavonEditor from 'mavon-editor'
import 'mavon-editor/dist/css/index.css'
import './assets/css/iconfont.css'
import { emoji } from './utils/emoji'

Vue.config.productionTip = false
Vue.use(Element)
Vue.use(Base)
Vue.use(mavonEditor)
Vue.prototype.axios=Http
Vue.prototype.emoji = emoji

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
