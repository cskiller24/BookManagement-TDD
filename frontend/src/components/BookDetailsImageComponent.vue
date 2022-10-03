<template>
  <img :src="firstImage" alt="" class="book-img" />
</template>
<script>
import { ref } from "vue";

export default {
  setup(props) {
    const firstImage = ref(props.images[0].path);

    console.log(firstImage);

    return { firstImage };
  },
  props: {
    images: Array,
  },
};
</script>
<style scoped>
.book-img {
  max-height: 100%;
  width: auto;
}
</style>
