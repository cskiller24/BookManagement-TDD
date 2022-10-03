<template>
  <div class="grid md:grid-cols-4 gap-4">
    <div class="col-span-1">
      <book-details-image-component :images="images" />
    </div>
    <div class="col-span-3">
      <book-details-component v-bind="{ title, description, user }" />
    </div>
    <div class="col-span-1">
      <p>Genre: {{ genre.title }}</p>
      <p>Rating: {{ average_review }}</p>
      <book-recommendation-component v-bind="recommendation" class="mt-5" />
    </div>
    <div class="col-span-3">
      <div class="flex justify-between items-baseline">
        <p class="text-subHeader">Reviews</p>
        <div class="space-x-4 align-bottom">
          <a href="">Add review</a>
          <a href="">Latest Reviews</a>
        </div>
      </div>
      <div v-for="review in reviews" :key="review.id" class="py-2">
        <review-component v-bind="review" />
      </div>
    </div>
  </div>
</template>
<script>
import BookDetailsComponent from "@/components/BookDetailsComponent.vue";
import BookRecommendationComponent from "@/components/BookRecomendationComponent.vue";
import ReviewComponent from "@/components/ReviewComponent.vue";
import BookDetailsImageComponent from "@/components/BookDetailsImageComponent.vue";
import { setTitle } from "@/helpers/title";
import { computed, onUpdated } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";

export default {
  async setup() {
    const route = useRoute();
    const store = useStore();

    const id = route.params.id;

    await store.dispatch("BOOK_GET", { id: id });

    const book = computed(() => store.getters.getBook);

    const {
      title,
      description,
      reviews,
      images,
      user,
      featured_image,
      genre,
      average_review,
      recommendation,
    } = book.value;

    console.log(book.value);

    setTitle(book.value.title);

    return {
      id,
      title,
      description,
      reviews,
      images,
      user,
      featured_image,
      genre,
      average_review,
      recommendation,
    };
  },
  components: {
    BookDetailsComponent,
    BookRecommendationComponent,
    ReviewComponent,
    BookDetailsImageComponent,
  },
};
</script>

<style scoped>
.book-information {
  max-height: 100%;
  width: 400px;
}
</style>
