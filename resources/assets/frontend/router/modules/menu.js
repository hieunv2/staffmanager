import Layout from '@/frontend/views/layout/Layout'

console.log(123, Layout)
const menuRouter = [
  {
    path: '/welcome',
    component: Layout,
    children: [
      {
        path: '',
        component: () => import('@/frontend/views/Introduce/Welcome'),
        name: 'Welcome',
        meta: { title: 'Welcome' }
      }
    ]
  },
  {
    path: '/who',
    component: Layout,
    children: [
      {
        path: '',
        component: () => import('@/frontend/views/Introduce/Who'),
        name: 'Who',
        meta: { title: 'Who', noContainer: true }
      }
    ]
  },
  {
    path: '/what',
    component: Layout,
    children: [
      {
        path: '',
        component: () => import('@/frontend/views/Introduce/What'),
        name: 'What',
        meta: { title: 'What' }
      },
      {
        path: 'individual',
        component: () => import('@/frontend/views/Introduce/Individual'),
        name: 'Individual',
        meta: { title: 'Individual' }
      },
      {
        path: 'organization',
        component: () => import('@/frontend/views/Introduce/Organization'),
        name: 'Organization',
        meta: { title: 'Organization' }
      },
      {
        path: 'talent-development',
        component: () => import('@/frontend/views/Introduce/Individual'),
        name: 'Talent Development',
        meta: { title: 'Talent Development' }
      },
      {
        path: 'organization-development',
        component: () => import('@/frontend/views/Introduce/Individual'),
        name: 'Organization Development',
        meta: { title: 'Organization Development' }
      }
    ]
  },
  {
    path: '/partner',
    component: Layout,
    children: [
      {
        path: '',
        component: () => import('@/frontend/views/Introduce/Partner'),
        name: 'Partner',
        meta: { title: 'Partner' }
      }
    ]
  },
  {
    path: '/achieve',
    component: Layout,
    children: [
      {
        path: '',
        component: () => import('@/frontend/views/Introduce/Achieve'),
        name: 'Achieve',
        meta: { title: 'Achieve' }
      }
    ]
  }
]
export default menuRouter
