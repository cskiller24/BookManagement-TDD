<template>
  <div class="border border-black recommendation_image rounded-md">
    <a :href="'/book/' + id">
      <div>
        <img :src="first_image" :alt="title" class="rounded-md" />
        <div class="mt-3 text-center">
          {{ shortTitle }}
        </div>
      </div>
    </a>
  </div>
</template>
<script>
import { computed } from "vue";

export default {
  setup(props) {
    const first_image = computed(() => props.images[0].path);

    const shortTitle = computed(() => {
      if (props.title.length > 30) {
        return props.title.substr(0, 30).concat(".....");
      }
      return props.title;
    });

    return { first_image, shortTitle };
  },
  props: {
    id: Number,
    title: String,
    description: String,
    images: Array,
  },
};
</script>

<style scoped>
.recommendation_image {
  max-height: 100%;
  width: 75%;
}
</style>
