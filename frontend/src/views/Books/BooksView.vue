<template>
    <section class="flex flex-wrap justify-center">
        <book-frame-component
            v-for="book in listOfBooks"
            :key="book.id"
            v-bind="book"
        />
    </section>
</template>
<script lang="ts" setup>
import BookFrameComponent from "@/components/books/BookFrameComponent.vue";
import books from "@/tests/books";
import { ref } from "vue";

const listOfBooks = ref(books);
</script>
