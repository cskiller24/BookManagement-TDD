import { createWebHistory, createRouter } from "vue-router";
import store from "@/store";
import MainLayout from "@/layouts/MainLayout.vue";
const routes = [
  {
    name: "User",
    path: "/home",
    redirect: "/",
    component: MainLayout,
    children: [
      {
        name: "Home",
        path: "/",
        component: () => import("@/views/HomeView.vue"),
      },
      {
        name: "About",
        path: "/about",
        component: () => import("@/views/AboutView.vue"),
      },
      {
        name: "Genres",
        path: "/genres",
        component: () => import("@/views/GenresView.vue"),
      },
      {
        name: "MyBooks",
        path: "/my-books",
        component: () => import("@/views/books/MyBooksView.vue"),
        meta: {
          requiresAuthentication: true,
          requiresVerified: true,
        },
      },
      {
        name: "Books",
        path: "/books",
        component: () => import("@/views/books/BooksView.vue"),
      },
    ],
  },
  {
    name: "Guest",
    path: "/guest",
    redirect: "/login",
    meta: {
      requiresGuest: true,
    },
    children: [
      {
        name: "Login",
        path: "/login",
        component: () => import("@/views/auth/LoginView.vue"),
      },
      {
        name: "Register",
        path: "/register",
        component: () => import("@/views/auth/RegisterView.vue"),
      },
    ],
  },
  {
    name: "Auth",
    path: "/auth",
    redirect: "/",
    meta: {
      requiresAuthentication: true,
    },
    children: [
      {
        name: "EmailVerify",
        path: "/email-verify/:hash?",
        component: () => import("@/views/EmailVerifyView.vue"),
      },
    ],
  },
  {
    name: "Test",
    path: "/test",
    component: () => import("@/views/TestView.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuthentication && store.getters.isLoggedIn) {
    next({ name: "Login" });
  } else if (to.meta.requiresGuest && store.getters.isLoggedIn) {
    console.log("eto??");
    next({ name: "Home" });
  } else if (
    to.meta.requiresAuthentication &&
    to.meta.requiresVerified &&
    store.getters.isLoggedIn &&
    !store.getters.isVerified
  ) {
    next({ name: "EmailVerify" });
  } else {
    next();
  }
});

export default router;
