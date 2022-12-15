import title from "@/helpers/title";
import { createRouter, createWebHistory } from "vue-router";
import NotFound from "@/views/Generic/NotFoundView.vue";
import HomeLayout from "@/layouts/HomeLayout.vue";
import GenericView from "@/views/Generic/GenericView.vue";
import { GenresTypeView, GenresView } from "@/views/Genres";

import {
    BooksCreateView,
    BooksUserView,
    BookView,
    BooksView,
    BooksEditView,
    BookImageEditView,
} from "@/views/Books";
import HomepageView from "@/views/HomepageView.vue";
import AboutView from "@/views/AboutView.vue";

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
            path: "/",
            component: HomeLayout,
            children: [
                {
                    name: "Home",
                    path: "",
                    component: HomepageView,
                    meta: { title: "Home" },
                },
                {
                    name: "About",
                    path: "about",
                    component: AboutView,
                    meta: { title: "About" },
                },
                {
                    name: "Genres",
                    path: "genres",
                    component: GenericView,
                    children: [
                        {
                            // genres
                            name: "Genres",
                            path: "",
                            component: GenresView,
                            meta: { title: "Genres" },
                        },
                        {
                            // /genres/:type
                            name: "Genres Type",
                            path: ":type",
                            component: GenresTypeView,
                        },
                    ],
                },
                {
                    name: "BooksGeneric",
                    path: "books",
                    component: GenericView,
                    children: [
                        {
                            name: "Books",
                            path: "",
                            component: BooksView,
                            meta: { title: "Books" },
                        },
                        {
                            name: "Book",
                            path: ":bookId",
                            component: BookView,
                            meta: { title: "Book" },
                        },
                        {
                            name: "Books User",
                            path: "user",
                            component: BooksUserView,
                            meta: { title: "My Books" },
                        },
                        {
                            name: "Books Create",
                            path: "create",
                            component: BooksCreateView,
                            meta: { title: "Create book" },
                        },
                        {
                            name: "Book Edit",
                            path: ":bookId/edit",
                            component: BooksEditView,
                        },
                        {
                            name: "Book Images Edit",
                            path: ":bookId/images",
                            component: BookImageEditView,
                        },
                    ],
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
