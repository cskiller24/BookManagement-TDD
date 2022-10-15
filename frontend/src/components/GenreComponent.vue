<template>
  <router-link
    :to="'/books?genre=' + id"
    class="border-4 border-black rounded-md p-3 w-54 m-3 flex flex-col items-center"
  >
    <img :src="image.path" class="main-image" />
    <p class="text-center text-xl">{{ title }}</p>
  </router-link>
</template>
<script>
export default {
  setup() {},
  props: {
    image: Object,
    id: Number,
    title: String,
    description: String,
  },
};
</script>

<style scoped>
.main-image {
  max-width: 100%;
  height: 150px;
}
</style>
