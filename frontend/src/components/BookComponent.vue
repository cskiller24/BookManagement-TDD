<template>
  <router-link :to="{ name: 'Book', params: { id: id } }">
    <div class="border rounded-md border-black w- p-3 bg-white w-400 m-2">
      <div>
        <img v-bind:src="firstImage" alt="" class="main-image" />
        <div class="text-center mt-2">{{ shortTitle }}</div>
      </div>
    </div>
  </router-link>
</template>

<script>
import { setTitle } from "@/helpers/title";
import { computed } from "vue";

export default {
  setup(props) {
    setTitle("Books");
    const text_length = 30;

    const shortTitle = computed(() => {
      if (props.title.length > text_length) {
        return props.title.substr(0, text_length).concat(".....");
      }
      return props.title;
    });

    const firstImage = computed(() => props.images[0].path);

    return { shortTitle, firstImage };
  },
  props: {
    id: Number,
    title: {
      type: String,
      default: "x",
    },
    description: String,
    favorites_count: Number,
    featured_image: Object,
    images: Array,
    user: Object,
    genre: Object,
  },
};
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
