import title from "@/helpers/title";
import { createRouter, createWebHistory } from "vue-router";
import NotFound from "@/views/Generic/NotFoundView.vue";
import HomeLayout from "@/layouts/HomeLayout.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            name: "Login",
            path: "/login",
            component: () => import("@/views/Auth/LoginView.vue"),
            meta: { title: "Login" },
        },
        {
            name: "Register",
            path: "/register",
            component: () => import("@/views/Auth/RegisterView.vue"),
            meta: { title: "Register" },
        },
        {
            name: "EmailVerify",
            path: "/email-verify",
            component: () => import("@/views/Auth/EmailVerifyView.vue"),
            meta: { title: "Email Verify" },
        },
        {
            name: "HomeLayout",
            path: "/home",
            redirect: "/",
            component: HomeLayout,
            children: [
                {
                    name: "Home",
                    path: "/",
                    component: () => import("@/views/HomepageView.vue"),
                    meta: { title: "Home" },
                },
                {
                    name: "About",
                    path: "/about",
                    component: () => import("@/views/AboutView.vue"),
                    meta: { title: "About" },
                },
                {
                    name: "Genres",
                    path: "/genres",
                    component: () => import("@/views/Genres/GenresView.vue"),
                    meta: { title: "Genres" },
                },
                {
                    name: "Genres Type",
                    path: "/genres/:type",
                    component: () =>
                        import("@/views/Genres/GenresTypeView.vue"),
                    meta: { title: "Genres" },
                },
            ],
        },
        // Not found page
        {
            name: "NotFound",
            path: "/:pathMatch(.*)*",
            component: NotFound,
            meta: { title: "404 Not found" },
        },
    ],
});

router.beforeEach((to, from, next) => {
    // Configure homepage title
    title(to.meta.title);

    next();
});

export default router;
