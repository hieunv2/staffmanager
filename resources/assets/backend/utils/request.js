import axios from 'axios'
import { Message } from 'element-ui'
import store from '../store'
import { getToken } from '../../common/utils/auth'
// create an axios instance
const service = axios.create({
	baseURL: process.config.BASE_ADMIN_API, // api base_url
	timeout: 30000 // request timeout
})
// request interceptor
service.interceptors.request.use(
	config => {
		// Do something before request is sent
		if (store.getters.token) {
			// config.headers['X-Token'] = getToken()
			config.headers['Authorization'] = 'Bearer ' + getToken()
		}
		return config
	},
	error => {
		// Do something with request error
		console.log(error) // for debug
		Promise.reject(error)
	}
)

// response interceptor
service.interceptors.response.use(
	response => {
		if (response.data.message) {
			Message({
				message: response.data.message,
				type: 'success',
				duration: 5 * 1000
			})
		}
		return response
	},

	error => {
		console.log('err' + error) // for debug
		let mess = ''
		if (error.response.status === 500) {
			mess = 'message.serverError'
		}
		if (error.response.status === 401 || error.status === 403) {
			mess = 'message.unauthorized'
		}
		if (mess) {
			// Message({
			//   message: i18n.t(mess),
			//   type: 'error',
			//   duration: 5 * 1000
			// })
		}
		return Promise.reject(error)
	}
)

export default service
