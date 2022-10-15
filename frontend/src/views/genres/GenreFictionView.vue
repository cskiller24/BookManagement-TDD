<template>
  <div class="flex flex-column flex-wrap justify-center">
    <div v-for="genre in genres" key="genre.id">
      <genre-component v-bind="genre" />
    </div>
  </div>
</template>
<script>
import { computed } from "vue";
import { useStore } from "vuex";
import GenreComponent from "@/components/GenreComponent.vue";
import { setTitle } from "@/helpers/title";

export default {
  async setup() {
    setTitle("Genre Fiction");

    const store = useStore();
    await store.dispatch("GENRES_GET", { params: { type: "fiction" } });

    const genres = computed(() => store.getters.getGenres);

    return { genres };
  },
  components: { GenreComponent },
};
</script>
