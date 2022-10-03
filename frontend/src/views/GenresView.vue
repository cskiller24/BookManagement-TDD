<template>
  <section>
    <p class="text-header flex justify-center align-items-center md:mb-20">
      Select Genre
    </p>
    <div class="grid md:grid-cols-2 place-items-center justify-items-center">
      <router-link class="flex justify-center items-center" to="">
        <img src="@/assets/books/fiction.svg" alt="" />
      </router-link>
      <div class="flex justify-center items-center">2</div>
    </div>
  </section>
</template>

<script>
import { setTitle } from "@/helpers/title";

export default {
  setup() {
    setTitle("Genres");
  },
};
</script>
