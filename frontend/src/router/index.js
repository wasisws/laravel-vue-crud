//import vue router
import { createRouter, createWebHistory } from "vue-router";
//define a routes
const routes = [
  {
    path: "/",
    name: "auth.login",
    component: () => import("@/views/auth/Login.vue"),
  },
  {
    path: "/register",
    name: "auth.register",
    component: () => import("@/views/auth/Register.vue"),
  },
  {
    path: "/logout",
    name: "auth.logout",
    component: () => import("@/views/auth/Logout.vue"),
  },
  {
    path: "/user",
    name: "siswa.user",
    component: () =>
      import(/* webpackChunkName: "siswa.user" */ "@/views/siswa/Index.vue"),
  },
  {
    path: "/siswa",
    name: "siswa.siswa",
    component: () =>
      import(/* webpackChunkName: "siswa.siswa" */ "@/views/siswa/Siswa.vue"),
  },
  {
    path: "/create",
    name: "siswa.create",
    component: () =>
      import(/* webpackChunkName: "siswa.create" */ "@/views/siswa/Create.vue"),
  },
  {
    path: "/edit/:id",
    name: "siswa.edit",
    component: () =>
      import(/* webpackChunkName: "siswa.edit" */ "@/views/siswa/Edit.vue"),
  },
];
//create router

const router = createRouter({
  history: createWebHistory(),
  routes, // config routes
});
export default router;
