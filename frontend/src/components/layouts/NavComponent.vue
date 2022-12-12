<template>
    <nav class="container mx-auto my-4">
        <div class="flex justify-between items-center">
            <router-link :to="{ name: 'Home' }">
                <section class="flex items-center" id="logo">
                    <img src="@/assets/logo.svg" class="w-auto h-12 pr-1" />
                    <h1 class="text-header center">BookEx</h1>
                </section>
            </router-link>
            <div
                class="hidden md:flex justify-evenly items-center space-x-12 self-center whitespace-nowrap"
            >
                <link-component
                    class="px-4 py-3"
                    v-for="(link, index) in links"
                    :is-named-link="false"
                    :name="link.title"
                    :redirect-link="link.link"
                    :key="index"
                />
            </div>
            <div class="self-center flex justify-end">
                <div class="md:block hidden">
                    <link-component
                        v-if="!isLoggedIn"
                        class-style="text-input"
                        :is-named-link="false"
                        name="Login"
                        redirect-link="/login"
                    />
                    <dropdown-component v-else />
                </div>
                <div class="block md:hidden" @click="toggleResponsiveDropdown">
                    <img
                        src="@/assets/hamburger-menu.svg"
                        alt="Hambuger menu"
                        height="35"
                        width="35"
                    />
                </div>
            </div>
        </div>
        <div class="css">
            <div :class="cardCssDesign">
                <div v-for="(link, index) in links" :key="index">
                    <link-component
                        @router-click="toggleResponsiveDropdown"
                        class="ml-2 my-2 w-full"
                        :name="link.title"
                        :redirect-link="link.link"
                        :is-named-link="false"
                    />
                    <hr class="border-black" />
                </div>
                <link-component
                    class="ml-2 mt-3 mb-2 w-full"
                    :is-named-link="false"
                    name="Profile"
                    redirect-link="/user"
                />
                <hr class="border-black" />
                <!-- To be implemented logout -->
                <div class="cursor-pointer mt-3 ml-2">Logout</div>
            </div>
        </div>
    </nav>
</template>

<script lang="ts">
import LinkComponent from "@/components/generic/LinkComponent.vue";
import DropdownComponent from "@/components/layouts/DropdownComponent.vue";
export default {
    data() {
        return {
            links: [
                { title: "About", link: "/about" },
                { title: "Books", link: "/books" },
                { title: "Genres", link: "/genres" },
                { title: "My Books", link: "/books/user" },
            ],
            guestLinks: [
                { title: "Login", link: "/login" },
                { title: "Register", link: "/register" },
            ],
            isLoggedIn: true,
            responsiveDropdown: false,
        };
    },
    methods: {
        toggleResponsiveDropdown() {
            this.responsiveDropdown = !this.responsiveDropdown;
        },
    },
    computed: {
        cardCssDesign(): String {
            return this.responsiveDropdown
                ? "border-2 border-black p-2 mt-3 rounded md:hidden mx-3"
                : "hidden ";
        },
    },
    components: { LinkComponent, DropdownComponent },
};
</script>
