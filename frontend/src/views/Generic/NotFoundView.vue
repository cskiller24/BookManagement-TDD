<template>
    <main class="min-h-screen flex justify-center items-center flex-col">
        <img
            src="@/assets/NotFound.svg"
            alt="Not found page"
            class="notFound"
            width="300"
            height="300"
        />
        <h1 class="text-5xl mt-3 font-bold">404 - Page not found.</h1>
        <h2 class="text-2xl mt-3">The page you requested does not exists.</h2>
        <link-component
            class="mt-5 border-black border-2 bg-black px-4 py-2 text-lg text-white rounded-full hover:border-2 hover:border-black hover:text-black hover:bg-white"
            redirect-link="/"
            name="Go to homepage"
        />
    </main>
</template>

<script lang="ts">
import LinkComponent from "@/components/generic/LinkComponent.vue";
export default {
    components: { LinkComponent },
};
</script>
