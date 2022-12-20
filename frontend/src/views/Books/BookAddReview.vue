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
            <form method="post">
                <h2 class="text-center text-subHeader">Add a review</h2>
                <textarea
                    class="border black w-full p-2 border-black rounded"
                    rows="12"
                ></textarea>
                <input
                    type="submit"
                    value="Submit"
                    class="py-1 text-center w-full border border-black bg-black text-white hover:bg-white hover:text-black rounded"
                />
            </form>
        </div>
    </section>
</template>

<script lang="ts" setup>
import title from "@/helpers/title";
import CarouselComponent from "@/components/books/CarouselComponent.vue";
import book from "@/tests/book";
import type { IBook } from "@/types/IBook";
import type { IImage } from "@/types/IImage";
import { ref, onMounted, onBeforeUnmount } from "vue";

const getBook = ref<IBook>(book);

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
