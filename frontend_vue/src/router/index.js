import Vue from "vue";
import store from "@/store/index";
import VueRouter from "vue-router";
import Products from "../views/Products.vue";
import Product from "../views/Product.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import Transaction from "../views/Transaction.vue";
import auth from "@/middleware/auth";
import guest from "@/middleware/guest";
import middlewarePipeline from "@/router/middlewarePipeline";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Products",
    component: Products,
  },
  {
    path: "/product/:id",
    name: "product",
    component: Product,
    props: true,
  },
  {
    path: "/login",
    component: Login,
    meta: { middleware: [guest] },
  },
  {
    path: "/register",
    component: Register,
    meta: { middleware: [guest] },
  },
  {
    path: "/profile",
    name: "Profile",
    meta: { middleware: [auth] },
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/Profile.vue"),
  },
  {
    path: "/wallet",
    meta: { middleware: [auth] },
    component: Transaction,
  },
  {
    path: "/:catchAll(.*)",
    name: "notFound",
    component: () =>
      import(/* webpackChunkName: "not-found" */ "../views/NotFound"),
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition;
    } else {
      return { x: 0, y: 0 };
    }
  },
});

router.beforeEach((to, from, next) => {
  const middleware = to.meta.middleware;
  const context = { to, from, next, store };

  if (!middleware) {
    return next();
  }

  middleware[0]({
    ...context,
    next: middlewarePipeline(context, middleware, 1),
  });
});

export default router;
