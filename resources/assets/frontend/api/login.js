import request from '@/frontend/request'

export function login(email, password) {
  const data = {
    email,
    password
  }
  return request({
    url: '/login',
    method: 'post',
    data
  })
}

export function logout() {
  return request({
    url: '/logout',
    method: 'post'
  })
}

export function getUserInfo(token) {
  return request({
    url: '/info',
    method: 'get',
    params: { token }
  })
}

