import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/layout/Main'
import Login from '@/views/Login'
import Register from '@/views/Register'
import PostList from '@/views/PostList'
import UserEdit from '@/views/UserEdit'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Main',
      component: Main,
      redirect:'/postlist',
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
        },
        {
          path:'postlist',
          name:'PostList',
          component:PostList
        },
        {
          path:'user_edit',
          name:'UserEdit',
          component:UserEdit
        }
      ]
    }
  ]
})
