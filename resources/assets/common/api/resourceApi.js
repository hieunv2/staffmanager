import backendRequest from '../../backend/utils/request'

export default class resourceApi {
  constructor(url, request = backendRequest) {
    this.url = url
    this.request = request
  }

  index = (query) => {
    return this.request({
      url: this.url,
      method: 'get',
      params: query
    })
  }

  create = (query) => {
    return this.request({
      url: this.url,
      method: 'post',
      data: query
    })
  }

  show = (query) => {
    return this.request({
      url: this.url + '/' + query.id,
      method: 'get',
      data: query
    })
  }

  edit = (query) => {
    if (query.id) {
      // update
      return this.request({
        url: this.url + '/' + query.id,
        method: 'patch',
        data: query
      })
    } else {
      // create
      return this.request({
        url: this.url,
        method: 'post',
        data: query
      })
    }
  }

  delete = (query) => {
    return this.request({
      url: this.url + '/' + query.id,
      method: 'delete',
      data: query
    })
  }
}
