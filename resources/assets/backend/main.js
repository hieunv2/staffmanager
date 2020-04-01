import Vue from 'vue'

import Cookies from 'js-cookie'

import 'normalize.css/normalize.css' // a modern alternative to CSS resets

import Element from 'element-ui'
import './styles/element-variables.scss'

import '@/backend/styles/index.scss' // global css

import App from './App'
import store from './store'
import router from './router'

import i18n from '@/common/lang' // internationalization
import '../common/icons' // icon
import './permission' // permission control
import '../common/utils/error-log' // error log
import * as utils from '@/common/utils/index'
Vue.mixin({
	methods: {
		...utils
	}
})

import * as filters from '@/common/filters' // global filters

// import VueAnalytics from 'vue-analytics'
//
// Vue.use(VueAnalytics, {
//   id: 'UA-109340118-1',
//   router
// })

/**
 * If you don't want to use mock-server
 * you want to use MockJs for mock api
 * you can execute: mockXHR()
 *
 * Currently MockJs will be used in the production environment,
 * please remove it before going online! ! !
 */


Vue.use(Element, {
  size: Cookies.get('size') || 'medium', // set element-ui default size
  i18n: (key, value) => i18n.t(key, value)
})

// register global utility filters
Object.keys(filters).forEach(key => {
  Vue.filter(key, filters[key])
})

Vue.config.productionTip = false

new Vue({
  el: '#app',
  router,
  store,
  i18n,
  render: h => h(App)
})
