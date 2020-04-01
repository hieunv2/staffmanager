import request from '../utils/request'

export default class resourceApi {
  constructor(url) {
    this.url = url
  }

  index = (query) => {
    return request({
      url: this.url,
      method: 'get',
      params: query
    })
  }

  create = (query) => {
    return request({
      url: this.url,
      method: 'post',
      data: query
    })
  }

  show = (query) => {
    return request({
      url: this.url + '/' + query.id,
      method: 'get',
      data: query
    })
  }

  edit = (query) => {
    if (query.id) {
      // update
      return request({
        url: this.url + '/' + query.id,
        method: 'patch',
        data: query
      })
    } else {
      // create
      return request({
        url: this.url,
        method: 'post',
        data: query
      })
    }
  }

  delete = (query) => {
    return request({
      url: this.url + '/' + query.id,
      method: 'delete',
      data: query
    })
  }
}
