<template>
  <div class="bg-slate-300 p-2">
    <div class="flex justify-between">
      <p>{{ userName }}</p>
      <p>Rating: {{ star }}</p>
    </div>
    <hr class="border-black my-2" />
    <div class="font-bold text-lg">{{ title }}</div>
    <div>{{ description }}</div>
  </div>
</template>
<script>
import { computed } from "vue";

export default {
  setup(props) {
    const userName = computed(() => props.user.name);
    return { userName };
  },
  props: {
    id: Number,
    star: Number,
    user: Object,
    description: String,
    title: String,
  },
};
</script>
