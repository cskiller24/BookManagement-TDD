<template>
    <section class="grid md:grid-cols-3 grid-cols-1 gap-3 sm:mx-0 mx-3">
        <div
            class="border-black border-2 rounded col-span-1"
            v-for="(image, index) in images"
            :key="image.id"
        >
            <div class="grid grid-cols-2 gap-1">
                <img :src="image.path" alt="Path" class="col-span-2" />
                <button
                    class="border border-black bg-black text-white py-1 text-center hover:bg-white hover:text-black"
                >
                    Set as featured
                </button>
                <button
                    class="border border-black bg-black text-white py-1 text-center hover:bg-white hover:text-black"
                >
                    Delete
                </button>
            </div>
        </div>

        <div class="md:col-span-3 col-span-1 flex justify-center">
            <button
                class="border p-2 block rounded md:w-1/3 w-full border-black bg-black text-white py-1 text-center hover:bg-white hover:text-black"
            >
                Add Image
            </button>
        </div>
    </section>
</template>

<script lang="ts" setup>
import book from "@/tests/book";
import type { IBook } from "@/types/IBook";
import type { IImage } from "@/types/IImage";
import { ref, computed } from "vue";

const getBook = ref<IBook>(book);

const DEFAULT_IMAGE =
    "http://api.book-management.test:8000/storage/images/default_image.png";

const images = ref<Array<IImage>>([
    {
        id: 1,
        path: DEFAULT_IMAGE,
    },
    {
        id: 2,
        path: DEFAULT_IMAGE,
    },
    {
        id: 3,
        path: DEFAULT_IMAGE,
    },
]);

const bookImagesCount = computed<number>(() => book.images.length);

const previewImage = (e: Event, id: number) => {
    const file = e.target?.files[0];
    images.value[id].path = URL.createObjectURL(file);
};
</script>
