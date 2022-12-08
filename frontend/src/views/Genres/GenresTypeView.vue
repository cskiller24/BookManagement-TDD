<template>
    <section>
        <h2 class="text-subHeader text-center font-semibold">
            {{ titleDisplay }}
        </h2>
        <div
            class="grid lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-2 grid-cols-1"
        >
            <genre-display-component
                v-for="genre in genreTypeData"
                :key="genre.id"
                v-bind="genre"
            />
        </div>
    </section>
</template>
<script setup lang="ts">
import genre from "@/tests/genre";
import { ref, computed } from "vue";
import type { Ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import title from "@/helpers/title";
import type { IGenre } from "@/types/IGenre";
import GenreDisplayComponent from "@/components/genres/GenreDisplayComponent.vue";

const route = useRoute();
const router = useRouter();

const type: string = route.params.type;

const genres: Ref<IGenre[]> = ref(genre);
const titleDisplay: Ref<String> = ref("");

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
        return;
    }
    genreType == "fiction"
        ? title("Genre Fiction")
        : title("Genre Non-Fiction");

    genreType == "fiction"
        ? (titleDisplay.value = "Fiction")
        : (titleDisplay.value = "Non-Fiction");
};

validatePath(type);
</script>
