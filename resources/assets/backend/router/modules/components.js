/** When your routing table is too long, you can split it into small modules **/

import Layout from '@/backend/layout'

const componentsRouter = {
  path: '/components',
  component: Layout,
  redirect: 'noRedirect',
  name: 'ComponentDemo',
  meta: {
    title: 'components',
    icon: 'component'
  },
  children: [
    {
      path: 'tinymce',
      component: () => import('@/backend/views/components-demo/tinymce'),
      name: 'TinymceDemo',
      meta: { title: 'tinymce' }
    },
    {
      path: 'markdown',
      component: () => import('@/backend/views/components-demo/markdown'),
      name: 'MarkdownDemo',
      meta: { title: 'markdown' }
    },
    {
      path: 'json-editor',
      component: () => import('@/backend/views/components-demo/json-editor'),
      name: 'JsonEditorDemo',
      meta: { title: 'jsonEditor' }
    },
    {
      path: 'split-pane',
      component: () => import('@/backend/views/components-demo/split-pane'),
      name: 'SplitpaneDemo',
      meta: { title: 'splitPane' }
    },
    {
      path: 'avatar-upload',
      component: () => import('@/backend/views/components-demo/avatar-upload'),
      name: 'AvatarUploadDemo',
      meta: { title: 'avatarUpload' }
    },
    {
      path: 'dropzone',
      component: () => import('@/backend/views/components-demo/dropzone'),
      name: 'DropzoneDemo',
      meta: { title: 'dropzone' }
    },
    {
      path: 'sticky',
      component: () => import('@/backend/views/components-demo/sticky'),
      name: 'StickyDemo',
      meta: { title: 'sticky' }
    },
    {
      path: 'count-to',
      component: () => import('@/backend/views/components-demo/count-to'),
      name: 'CountToDemo',
      meta: { title: 'countTo' }
    },
    {
      path: 'mixin',
      component: () => import('@/backend/views/components-demo/mixin'),
      name: 'ComponentMixinDemo',
      meta: { title: 'componentMixin' }
    },
    {
      path: 'back-to-top',
      component: () => import('@/backend/views/components-demo/back-to-top'),
      name: 'BackToTopDemo',
      meta: { title: 'backToTop' }
    },
    {
      path: 'drag-dialog',
      component: () => import('@/backend/views/components-demo/drag-dialog'),
      name: 'DragDialogDemo',
      meta: { title: 'dragDialog' }
    },
    {
      path: 'drag-select',
      component: () => import('@/backend/views/components-demo/drag-select'),
      name: 'DragSelectDemo',
      meta: { title: 'dragSelect' }
    },
    {
      path: 'dnd-list',
      component: () => import('@/backend/views/components-demo/dnd-list'),
      name: 'DndListDemo',
      meta: { title: 'dndList' }
    },
    {
      path: 'drag-kanban',
      component: () => import('@/backend/views/components-demo/drag-kanban'),
      name: 'DragKanbanDemo',
      meta: { title: 'dragKanban' }
    }
  ]
}

export default componentsRouter
