import Vue from 'vue'
import Router from 'vue-router'
import Main from '@/layout/Main'
import Login from '@/views/Login'
import Register from '@/views/Register'
import PostList from '@/views/PostList'
import UserEdit from '@/views/UserEdit'
import TopicEdit from '@/views/TopicEdit'
import TopicShow from '@/views/TopicShow'
import UserCenter from '@/views/UserCenter'
import UserInfoBox from '@/components/UserInfoBox'
import UserTopicList from '@/components/UserTopicList'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Main',
      component: Main,
      redirect: '/postlist',
      children: [
        {
          path: 'login',
          name: 'Login',
          component: Login
        },
        {
          path: 'register',
          name: 'Register',
          component: Register
        },
        {
          path: 'postlist',
          name: 'PostList',
          component: PostList
        },
        {
          path: 'user_edit',
          name: 'UserEdit',
          component: UserEdit
        },
        {
          path: 'topic_edit',
          name: 'TopicEdit',
          component: TopicEdit
        },
        {
          path: 'topic_show',
          name: 'TopicShow',
          component: TopicShow
        },
        {
          path: 'user_center',
          name: 'UserCenter',
          component: UserCenter,
          children: [
            {
              path: '/user_center/user_info',
              name: 'UserInfoBox',
              component: UserInfoBox
            },
            {
              path: '/user_center/user_topic',
              name: 'UserTopicList',
              component: UserTopicList
            }
          ]

        }
      ]
    }
  ]
})
