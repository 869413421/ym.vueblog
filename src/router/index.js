import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/layout/Main'
import Login from '@/views/Login'
import Register from '@/views/Register'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Main',
      component: Main,
      children:[
        {
          path:'login',
          name:'Login',
          component:Login
        },
        {
          path:'register',
          name:'Register',
          component:Register
        }
      ]
    }
  ]
})
