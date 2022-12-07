<template></template>
<script setup lang="ts">
import genre from "@/tests/genre";
import { computed } from "@vue/reactivity";
import { ref } from "vue";
import type { Ref } from "vue";
import { useRoute, useRouter } from "vue-router";

interface IGenre {
    image: {
        path: string;
        id: number;
    };
    books: Array<IBook>;
    id: number;
    title: string;
    type: string;
    description: string;
}

interface IBook {
    id: number;
    title: string;
    description: string;
}

const route = useRoute();
const router = useRouter();

const type: string = route.params.type;

const genres: Ref<IGenre[]> = ref(genre);

const genreTypeData = computed<IGenre[]>(() =>
    genres.value.filter((genre) => {
        if (type == "fiction") {
            return genre.type == "Fiction";
        }
        if (type == "non-fiction") {
            return genre.type == "Non-Fiction";
        }
        return false;
    })
);

const validatePath = (genreType: string): void => {
    if (!["fiction", "non-fiction"].includes(genreType)) {
        router.push({ name: "NotFound" });
    }
};

validatePath(type);
</script>
