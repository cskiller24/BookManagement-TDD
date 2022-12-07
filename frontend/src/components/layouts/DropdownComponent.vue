<template>
    <div>
        <div class="dropdown inline-block relative">
            <button
                class="bg-black text-white font-semibold py-2 px-4 rounded inline-flex items-center w-auto"
            >
                <span class="mr-1">Name</span>
                <svg
                    class="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                    />
                </svg>
            </button>
            <ul class="dropdown-menu absolute hidden text-gray-700 pt-1 w-auto">
                <li
                    class=""
                    v-for="(loggedInLink, index) in loggedInLinks"
                    :key="index"
                >
                    <link-component
                        classStyle="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                        :name="loggedInLink.name"
                        :isNamedLink="false"
                        :redirectLink="loggedInLink.redirectLink"
                    />
                </li>

                <li class="">
                    <p
                        class="cursor-pointer rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-wrap"
                    >
                        Logout
                    </p>
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>
.dropdown:hover .dropdown-menu {
    display: block;
}
</style>

<script lang="ts">
import LinkComponent from "@/components/generic/LinkComponent.vue";
export default {
    data() {
        return {
            loggedInLinks: [{ name: "Profile", redirectLink: "/user" }],
        };
    },
    components: { LinkComponent },
};
</script>
