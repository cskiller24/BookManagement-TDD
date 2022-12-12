<template>
    <router-link
        :to="{ name: 'Book', params: { bookId: props.id } }"
        class="border rounded-md border-black w- p-3 bg-white w-400 m-2"
    >
        <div>
            <img v-bind:src="firstImage" alt="" class="main-image" />
            <div class="text-center mt-2">{{ shortTitle }}</div>
        </div>
    </router-link>
</template>

<script lang="ts" setup>
import type { IBooks } from "@/types/IBooks";
import { computed } from "vue";

const props = defineProps<IBooks>();

const firstImage = computed(() => props.images[0].path);

const text_length = 50;
const shortTitle = computed(() => {
    if (props.title.length > text_length) {
        return props.title.substr(0, text_length).concat(".....");
    }
    return props.title;
});
</script>

<style scoped>
.main-image {
    max-width: 100%;
    height: 400px;
}
.w-400 {
    width: 300px;
}
</style>
