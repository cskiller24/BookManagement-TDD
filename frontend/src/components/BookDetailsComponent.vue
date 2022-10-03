<template>
  <div>
    <h1 class="text-header">{{ title }}</h1>
    <h2 class="text-subHeader mt-1">By {{ user.name }}</h2>
    <p class="mt-5 text-body">{{ description }}</p>
  </div>
</template>

<script>
export default {
  setup() {},
  props: {
    title: {
      default: " ",
      type: String,
    },
    description: String,
    user: Object,
  },
};
</script>

<style scoped>
.image {
  max-height: 100%;
  width: 450px;
}
</style>
