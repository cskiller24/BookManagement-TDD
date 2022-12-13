<template>
    <section>
        <div class="flex justify-between" id="books-nav">
            <p class="text-subHeader">Listed books ({{ userBook.length }})</p>
            <link-component
                class="bg-black py-1 px-4 text-lg rounded-md border-black border text-white hover:bg-white hover:text-black"
                redirect-link="/books/create"
                :is-named-link="false"
                name="Add a book"
            />
        </div>
        <div id="books-list" class="mt-4">
            <div class="my-2" v-for="(book, index) in userBook" :key="book.id">
                <book-card-component :book="book" :index="index" />
            </div>
        </div>
    </section>
</template>

<script lang="ts" setup>
import BookCardComponent from "@/components/books/BookCardComponent.vue";
import LinkComponent from "@/components/generic/LinkComponent.vue";
import books from "@/tests/books";
import type { IBooks } from "@/types/IBooks";
import { ref } from "vue";

const userBook = ref<Array<IBooks>>(books);
</script>
