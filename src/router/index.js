import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/layout/Main'
import Login from '@/layout/login'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Main',
      component: Main,
      children:[
        {
          path:'Login',
          name:'Login',
          component:Login
        }
      ]
    }
  ]
})
