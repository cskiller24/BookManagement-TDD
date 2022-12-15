<template>
    <main class="min-h-screen flex flex-col justify-between">
        <header class="container mx-auto mb-3">
            <nav-component />
        </header>
        <section id="main-content" class="container mx-auto mb-auto">
            <router-view />
        </section>
        <footer class="h-auto mt-8">
            <footer-component />
        </footer>
    </main>
</template>

<script lang="ts" setup>
import NavComponent from "@/components/layouts/NavComponent.vue";
import FooterComponent from "@/components/layouts/FooterComponent.vue";
</script>
