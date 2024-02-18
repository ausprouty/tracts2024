const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        name: "Index",
        path: "",
        component: () => import("pages/IndexPage.vue"),
      },
      {
        name: "ViewTract",
        path: "/tract/:tract/:fontSize?",
        component: () => import("src/pages/ViewTract.vue"),
      },
      {
        name: "BackgroundInformation",
        path: "/background",
        component: () => import("src/pages/BackgroundInformation.vue"),
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
