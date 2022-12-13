<template>
    <section
        class="flex justify-between w-full p-2 border-black border-2 rounded bg-slate-200"
    >
        <div>
            <p class="text-xl">Title: {{ book.title }}</p>
            <div class="flex">
                <p>Genre: &nbsp;</p>
                <p>{{ props.book.genre.title }}</p>
            </div>
        </div>
        <div
            class="flex items-center flex-col space-y-1 sm:space-x-6 sm:flex-row sm:space-y-0"
        >
            <link-component
                v-for="link in editLinks"
                :key="link.id"
                :is-named-link="false"
                :name="link.name"
                :redirect-link="link.link"
                class="bg-black text-white rounded-sm py-1 px-2 border border-black text-lg text-center w-full max-w-sm hover:bg-white hover:text-black"
            />
        </div>
    </section>
</template>

<script lang="ts" setup>
import LinkComponent from "../generic/LinkComponent.vue";

import type { IBooks } from "@/types/IBooks";

const props = defineProps<{ book: IBooks; index: number }>();
const editLinks = [
    {
        id: 1,
        name: "Edit",
        link: `/books/${props.book.id}/edit`,
    },
    {
        id: 2,
        name: "Delete",
        link: `/books/${props.book.id}/delete`,
    },
];
</script>
