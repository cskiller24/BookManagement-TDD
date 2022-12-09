<template>
    <section>
        <p class="text-header flex justify-center align-items-center mb-10">
            Select Genre
        </p>
        <div
            class="grid md:grid-cols-2 place-items-center justify-items-center mb-10"
        >
            <div v-for="genre in genres" :key="genre.id">
                <router-link
                    class="flex flex-col justify-center items-center border-black border-4 p-3 rounded-lg mb-5"
                    :to="genre.link"
                >
                    <img :src="genre.image" :alt="genre.name" />
                    <p class="mt-3 text-subHeader">{{ genre.name }}</p>
                </router-link>
            </div>
        </div>
    </section>
</template>
<script setup lang="ts">
const genres = [
    {
        id: 1,
        name: "Fiction",
        image: "/src/assets/books/fiction.svg",
        link: "/genres/fiction",
    },
    {
        id: 2,
        name: "Non-Fiction",
        image: "/src/assets/books/fiction.svg",
        link: "/genres/non-fiction",
    },
];
</script>
