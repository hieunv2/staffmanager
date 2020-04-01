import ResourceApi from '@/common/api/resourceApi'
import request from '@/frontend/request'
const resourceApi = new ResourceApi('contacts', request)

const exampleApi = {

	...resourceApi
}
export default exampleApi
