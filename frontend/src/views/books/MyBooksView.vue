<template>MyBooks</template>

<script>
import isLoadingComponent from "@/components/IsLoadingComponent.vue";
import { computed, onMounted, ref } from "vue";
import { useStore } from "vuex";

export default {
  async setup() {
    const store = useStore();
    const isLoading = ref(false);
    await store.dispatch("BOOKS_GET");
    const books = computed(() => store.getters.getBooks);

    return { isLoading, books };
  },
  components: { isLoadingComponent },
};
</script>
