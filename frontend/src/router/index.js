import { createWebHistory, createRouter } from "vue-router";
import store from "@/store";
import MainLayout from "@/layouts/MainLayout.vue";
import GuestLayout from "@/layouts/GuestLayout.vue";
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
        name: "Genres Fiction",
        path: "/genre/fiction",
        component: () => import("@/views/genres/GenreFictionView.vue"),
      },
      {
        name: "Genres Non-Fiction",
        path: "/genre/non-fiction",
        component: () => import("@/views/genres/GenreNonFictionView.vue"),
      },
      {
        name: "Genre",
        path: "/genre/i/:id",
        component: () => import("@/views/genres/GenreView.vue"),
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
      {
        name: "Book",
        path: "/book/:id",
        component: () => import("@/views/books/BookView.vue"),
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
    component: GuestLayout,
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
  // Logged in
  if (to.meta.requiresAuthentication && !store.getters.getIsLoggedIn) {
    console.log("1: ", store.getters.getIsLoggedIn);
    next({ name: "Login" });
  }
  // Logged in but not verified
  else if (
    to.meta.requiresAuthentication &&
    to.meta.requiresVerified &&
    store.getters.getIsLoggedIn &&
    !store.getters.getIsVerified
  ) {
    next({ name: "EmailVerify" });
  }
  // Logged in but requires guest
  else if (to.meta.requiresGuest && store.getters.getIsLoggedIn) {
    console.log("3: ", store.getters.getIsLoggedIn);
    next({ name: "Home" });
  } else {
    next();
  }
});

export default router;
