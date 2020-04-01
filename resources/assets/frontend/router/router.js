import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

/* Layout */
import Layout from '@/frontend/views/layout/Layout'

const menuRouter = [
]

export const constantRouterMap = [
  {
    path: '',
    component: () => import('@/frontend/views/layout/Layout'),
    children: [
      {
        path: 'index',
        component: () => import('@/frontend/views/home/Home'),
        name: 'Home',
        meta: { title: 'i18n', icon: 'international' }
      }
    ]
  },
  {
    path: '/login',
    component: () => import('@/frontend/views/login/login'),
    hidden: true
  },
  {
    path: '/auth-redirect',
    component: () => import('@/frontend/views/login/authredirect'),
    hidden: true
  },
  {
    path: '/404',
    component: () => import('@/frontend/views/errorPage/404'),
    hidden: true
  },
  {
    path: '/401',
    component: () => import('@/frontend/views/errorPage/401'),
    hidden: true
  },
  ...menuRouter
]

export default new Router({
  mode: 'history',
  scrollBehavior: function(to, from, savedPosition) {
    if (to.hash) {
      return { selector: to.hash }
    } else {
      return { x: 0, y: 0 }
    }
  },
  routes: constantRouterMap
})

export const asyncRouterMap = [
  {
    path: '/i18n',
    component: Layout,
    hidden: true,
    children: [
      {
        path: 'index',
        component: () => import('@/frontend/views/i18n-demo/index'),
        name: 'I18n',
        meta: { title: 'i18n', icon: 'international' }
      }
    ]
  },

  { path: '*', redirect: '/404', hidden: true }
]
