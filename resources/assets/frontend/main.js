import Vue from 'vue'

import Cookies from 'js-cookie'

import 'normalize.css/normalize.css' // A modern alternative to CSS resets

import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

import '@/frontend/styles/index.scss' // global css
import App from './App'
import router from './router/router'
import store from './store'

import i18n from '../common/lang' // Internationalization
import './errorLog' // error log
import './permission' // permission control

import * as filters from '../common/filters' // global filters

import lodash from 'lodash'
// import jquery from 'jquery'
// window.$ = window.jQuery = jquery
window._ = lodash

Vue.use(Element, {
  size: Cookies.get('size') || 'medium', // set element-ui default size
  i18n: (key, value) => i18n.t(key, value)
})

// register global utility filters.
Object.keys(filters).forEach(key => {
  Vue.filter(key, filters[key])
})

Vue.config.productionTip = false
Vue.component('app', App)

new Vue({
  el: '#app',
  router,
  store,
  i18n,
  mounted() {
    // You'll need this for renderAfterDocumentEvent.
    document.dispatchEvent(new Event('render-event'))
  },
  render: h => h(App)
})
