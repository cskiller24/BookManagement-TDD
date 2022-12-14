<template>
    <section class="grid lg:grid-cols-4 lg:gap-4 grid-cols-1">
        <div class="col-span-1 mb-2">
            <div class="carousel">
                <div class="carousel-inner border-black border-2">
                    <carousel-component
                        v-for="(slide, index) in slides"
                        :image="slide"
                        :key="slide.id"
                        :current-slide="currentSlide"
                        :index="index"
                    />
                </div>
            </div>
        </div>
        <div class="col-span-3">
            <p class="text-subHeader">{{ getBook.title }}</p>
            <p>{{ getBook.description }}</p>
        </div>
        <!-- Recommendation -->
        <div class="col-span-1 md:mt-0 mt-4">
            <div v-show="getBook.recommendation">
                <p>
                    Explore book in
                    <strong>{{ getBook.genre.title }}</strong> genre
                </p>
                <link-component
                    :is-named-link="false"
                    class="border-2 border-black p-2 rounded-md"
                    :name="getBook.recommendation?.title ?? ''"
                    :redirect-link="`/books/${getBook.recommendation?.id}`"
                />
            </div>
            <p v-show="!hasBookRecommendation">
                There's no book recommendation
            </p>
        </div>
        <!-- Reviews -->
        <div class="col-span-3 md:mt-0 mt-4">
            <div class="flex justify-between items-center">
                <p class="text-subHeader">Reviews</p>
                <div class="sm:flex block">
                    <link-component
                        class="sm:mr-3"
                        :is-named-link="false"
                        name="Add a review"
                        :redirect-link="`/books/get/${getBook.id}/reviews/add`"
                    />
                    <link-component
                        :is-named-link="false"
                        name="Latest reviews"
                        :redirect-link="`/books/${getBook.id}?sortBy=reviews`"
                    />
                </div>
            </div>
            <div
                v-for="review in getBook.reviews"
                :key="review.id"
                class="py-2"
            >
                <book-review-component v-bind="review" />
            </div>
        </div>
    </section>
</template>

<script lang="ts" setup>
import books from "@/tests/books";
import CarouselComponent from "@/components/books/CarouselComponent.vue";
import BookReviewComponent from "@/components/books/BookReviewComponent.vue";
import LinkComponent from "@/components/generic/LinkComponent.vue";
import { ref, onMounted, onBeforeUnmount } from "vue";
import { useRoute } from "vue-router";
import type { IImage } from "@/types/IImage";
import type { IBook } from "@/types/IBook";
import book from "@/tests/book";
import title from "@/helpers/title";

const listOfBooks = ref(books);
const route = useRoute();

const bookId = parseInt(route.params.bookId[0]);

const getBook = ref<IBook>(book);
const hasBookRecommendation = computed<boolean>(
    () => getBook.value.recommendation != null
);

const slides: Array<IImage> = [
    {
        id: 1,
        path: getBook.value.images[0].path,
    },
    {
        id: 2,
        path: "https://picsum.photos/id/1033/1800/2400",
    },
    {
        id: 3,
        path: "https://picsum.photos/id/1035/1800/2400",
    },
];

const currentSlide = ref<number>(0);
const slideInterval = ref<number>(0);

onMounted(() => {
    slideInterval.value = setInterval(() => {
        const index =
            currentSlide.value < slides.length - 1 ? currentSlide.value + 1 : 0;
        currentSlide.value = index;
    }, 3000);

    title(getBook.value.title);
});

onBeforeUnmount(() => {
    clearInterval(slideInterval.value);
});
</script>

<style scoped>
.carousel {
    display: flex;
    justify-content: center;
}

.carousel-inner {
    position: relative;
    height: 400px;
    width: 320px;
    overflow: hidden;
}
/*
@media (max-width: 1024px) {
    .carousel-inner {
        height: 360px;
    }
} */

@media (max-width: 1260px) and (min-width: 1024px) {
    .carousel-inner {
        height: 320px;
    }
}

@media (max-width: 425px) {
    .carousel-inner {
        height: 265px;
        width: 200px;
    }
}
</style>
