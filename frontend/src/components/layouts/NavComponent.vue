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
                    <div v-if="!isLoggedIn">
                        <link-component
                            v-for="(links, index) in guestLinks"
                            :key="index"
                            class-style="text-input"
                            :is-named-link="false"
                            :name="links.title"
                            :redirect-link="links.link"
                        />
                    </div>
                    <dropdown-component v-if="isLoggedIn" />
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

<script lang="ts" setup>
import LinkComponent from "@/components/generic/LinkComponent.vue";
import DropdownComponent from "@/components/layouts/DropdownComponent.vue";
import { ref, computed } from "vue";

const links = [
    { title: "About", link: "/about" },
    { title: "Books", link: "/books" },
    { title: "Genres", link: "/genres" },
    { title: "My Books", link: "/books/user" },
];

const guestLinks = [
    { title: "Login", link: "/login" },
    { title: "Register", link: "/register" },
];

const isLoggedIn = ref<boolean>(true);
const responsiveDropdown = ref<boolean>(false);

const toggleResponsiveDropdown = () => {
    responsiveDropdown.value = !responsiveDropdown.value;
};

const cardCssDesign = computed<string>(() =>
    responsiveDropdown.value
        ? "border-2 border-black p-2 mt-3 rounded md:hidden mx-3"
        : "hidden "
);
</script>
