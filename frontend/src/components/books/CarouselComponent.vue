<template>
    <transition name="slide-in">
        <section class="carousel-item" v-show="currentSlide === index">
            <img :src="image.path" alt="" />
        </section>
    </transition>
</template>

<script lang="ts" setup>
import type { IImage } from "@/types/IImage";

// eslint-disable-next-line vue/no-setup-props-destructure
const { image, currentSlide } = defineProps<{
    image: IImage;
    currentSlide: number;
    index: number;
}>();
</script>

<style scoped>
.carousel-item {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.slide-in-enter-active,
.slide-in-leave-active {
    transition: all 1s ease-in-out;
}

.slide-in-enter-from {
    transform: translateX(-100%);
}

.slide-in-leave-to {
    transform: translateX(100%);
}
</style>
