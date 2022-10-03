<template>
  <div class="flex flex-row flex-wrap justify-center">
    <div v-for="book in books" :key="book.id">
      <book-component v-bind="book" />
    </div>
  </div>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";
import BookComponent from "@/components/BookComponent.vue";
import { useRoute } from "vue-router";

export default {
  async setup() {
    const store = useStore();
    const route = useRoute();
    await store.dispatch("BOOKS_GET", { params: route.query });

    const books = computed(() => store.getters.getBooks);

    return { books };
  },
  components: { BookComponent },
};
</script>

<style scoped></style>
