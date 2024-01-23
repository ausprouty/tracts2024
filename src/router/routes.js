
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/IndexPage.vue') },
      {
        name: 'ViewTract',
        path: '/tract',
        component: () => import('src/pages/ViewTract.vue')
      },
    ]
  },
  {
    path: '/tract/:tract',
    component: () => import('pages/ViewTract.vue')
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
