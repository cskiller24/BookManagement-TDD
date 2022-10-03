<template>
  <div class="grid md:grid-cols-2 md:grid-flow-col">
    <div class="text-header mt-10">
      <p>
        “Fairy tales are more than true: not because they tell us that dragons
        exist, but because they tell us that dragons can be beaten.”
      </p>
      <br />
      <p>― Neil Gaiman, Coraline</p>
      <p class="text-subHeader mt-10 mb-3">
        In BookEx, you can explore different books in different genres, share
        your thoughts thru reviews. Develop skills more than you could imagine.
        A place belongs to everyone, begins in a journey of a single step.
      </p>
    </div>
    <div>
      <img src="@/assets/about.svg" alt="About" />
    </div>
  </div>
</template>

<script>
import { setTitle } from "@/helpers/title";

export default {
  setup() {
    setTitle("About");
  },
};
</script>
