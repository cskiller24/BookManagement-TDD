<template>
    <router-link
        :to="'/books?genre=' + id"
        class="border-4 border-black rounded-md p-3 w-54 m-3 flex flex-col items-center"
    >
        <img :src="props.image.path" class="main-image" />
        <p class="text-center text-xl break-words">{{ props.title }}</p>
    </router-link>
</template>

<script lang="ts" setup>
import type { IGenre } from "@/types/IGenre";

const props = defineProps<IGenre>();
</script>
