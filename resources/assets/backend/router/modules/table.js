/** When your routing table is too long, you can split it into small modules **/

import Layout from '@/backend/layout'

const tableRouter = {
  path: '/table',
  component: Layout,
  redirect: '/table/complex-table',
  name: 'Table',
  meta: {
    title: 'Table',
    icon: 'table'
  },
  children: [
    {
      path: 'dynamic-table',
      component: () => import('@/backend/views/table/dynamic-table/index'),
      name: 'DynamicTable',
      meta: { title: 'dynamicTable' }
    },
    {
      path: 'drag-table',
      component: () => import('@/backend/views/table/drag-table'),
      name: 'DragTable',
      meta: { title: 'dragTable' }
    },
    {
      path: 'inline-edit-table',
      component: () => import('@/backend/views/table/inline-edit-table'),
      name: 'InlineEditTable',
      meta: { title: 'inlineEditTable' }
    },
    {
      path: 'complex-table',
      component: () => import('@/backend/views/table/complex-table'),
      name: 'ComplexTable',
      meta: { title: 'complexTable' }
    }
  ]
}
export default tableRouter
