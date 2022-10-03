<template>
  <is-loading-component v-if="isLoading" />
  <div v-else>
    {{ book }}
    <div v-for="book in books" :key="book.id">
      <book-component v-bind="book" />
    </div>
  </div>
</template>
<script>
import BookComponent from "@/components/BookComponent.vue";
import IsLoadingComponent from "@/components/IsLoadingComponent.vue";
import { computed, onBeforeMount, onMounted, ref } from "vue";
import { useStore } from "vuex";

export default {
  async setup() {
    const store = useStore();
    const isLoading = ref(false);
    const sets = await store.dispatch("BOOKS_GET");
    const books = computed(() => store.getters.getBooks);

    return { isLoading, books };
  },
  components: { BookComponent, IsLoadingComponent },
};
</script>
