import { createRouter, createWebHistory } from "vue-router";
import { parseTitle } from "@/helpers";

const routes = [
  // Guest routes
  {
    path: "/home",
    name: "User",
    redirect: "/",
    component: () => import("@/layouts/UserLayout.vue"),
    meta: {
      requiresAuth: false,
    },
    children: [
      {
        path: "/",
        name: "Home",
        component: () => import("@/views/HomeView.vue"),
        meta: {
          title: parseTitle("Home"),
        },
      },
      {
        path: "/about",
        name: "About",
        component: () => import("@/views/AboutView.vue"),
        meta: {
          title: parseTitle("About"),
        },
      },
      {
        path: "/books",
        name: "Books",
        component: () => import("@/views/BooksView.vue"),
        meta: {
          title: parseTitle("Books"),
        },
      },
      {
        path: "/genres",
        name: "Genres",
        component: () => import("@/views/GenreView.vue"),
        meta: {
          title: parseTitle("Genres"),
        },
      },
    ],
  },
  {
    path: "/auth",
    name: "Auth",
    redirect: "/",
    component: () => import("@/layouts/UserLayout.vue"),
    meta: {
      requiresAuth: true,
      verified: true,
    },
    children: [
      {
        path: "/my-books",
        name: "MyBooks",
        component: () => import("@/views/auth/MyBooksView.vue"),
        meta: {
          title: parseTitle("My Books"),
        },
      },
    ],
  },
  // Requires guest
  {
    path: "/guest",
    name: "Guest",
    redirect: "/login",
    component: () => import("@/layouts/GuestLayout.vue"),
    meta: {
      isGuest: true,
    },
    children: [
      {
        path: "/login",
        name: "Login",
        meta: {
          title: parseTitle("Login"),
        },
        component: () => import("@/views/Guest/LoginView.vue"),
      },
      {
        path: "/register",
        name: "Register",
        meta: {
          title: parseTitle("Register"),
        },
        component: () => import("@/views/Guest/RegisterView.vue"),
      },
    ],
  },
  // Requires auth and verified
  {
    path: "/email/send",
    name: "SendEmailVerification",
    component: () => import("@/views/EmailConfirmationView"),
    meta: {
      title: parseTitle("Send Email Verification"),
      requiresAuth: true,
      verified: false,
    },
  },
  {
    path: "/test",
    component: () => import("@/components/FooterComponent.vue"),
  },
  // Not found
  {
    path: "/:pathMatch(.*)*",
    name: "NotFound",
    meta: {
      title: parseTitle("404 Not Found"),
    },
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  // Change every title to the meta title page or the name of the route
  document.title = to.meta.title ? to.meta.title : to.name;

  next();
});

export default router;
