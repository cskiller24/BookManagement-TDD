<template>
    <section
        class="flex flex-col justify-center border-2 border-black p-2 rounded-lg"
    >
        <h2 class="text-subHeader text-center">Edit a book</h2>
        <form method="post" class="space-y-2">
            <div>
                <label for="title">Title</label>
                <input
                    type="text"
                    class="w-full border-black focus:outline-black py-1 px-2 border rounded"
                    id="title"
                    :value="title"
                />
            </div>
            <div>
                <label for="description" class="text-lg">Description</label>
                <textarea
                    class="w-full border-black border rounded py-1 px-2"
                    rows="6"
                    id="description"
                    :value="description"
                ></textarea>
            </div>
            <genre-dropdown-component
                @selected-value="(genre) => (genreId = genre)"
            />
            <input
                type="submit"
                value="Submit"
                class="inline-block w-full bg-black py-1 rounded cursor-pointer text-center text-white border border-black hover:bg-white hover:text-black text-input"
            />
        </form>
    </section>
</template>
<script lang="ts" setup>
import GenreDropdownComponent from "@/components/genres/GenreDropdownComponent.vue";

import { ref } from "vue";

const title = ref<string>("");
const description = ref<string>("");
const genreId = ref<number>();
</script>
