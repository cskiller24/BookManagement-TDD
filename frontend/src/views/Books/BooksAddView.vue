<template>
    <form
        class="grid lg:grid-cols-4 grid-cols-1 gap-4"
        method="post"
        enctype="multipart/form-data"
    >
        <div class="col-span-1 flex justify-center">
            <img
                :src="path"
                alt="Book add image"
                class="fixed-image border border-black rounded"
            />
        </div>
        <form
            class="col-span-3 border-2 border-black p-2 rounded-lg space-y-2"
            method="post"
            enctype="multipart/form-data"
        >
            <h2 class="text-subHeader text-center">Add a book</h2>
            <div>
                <label for="title" class="text-lg">Title</label>
                <input
                    type="text"
                    id="title"
                    class="w-full border-black focus:outline-black py-1 px-2 border rounded"
                    required
                />
            </div>
            <div>
                <label for="description" class="text-lg">Description</label>
                <textarea
                    class="w-full border-black border rounded py-1 px-2"
                    rows="6"
                    id="description"
                ></textarea>
            </div>
            <div class="w-full">
                <label
                    for="imageAdd"
                    class="inline-block w-full bg-black py-1 rounded cursor-pointer text-center text-white border border-black hover:bg-white hover:text-black text-input"
                >
                    Add image
                </label>
                <input
                    type="file"
                    id="imageAdd"
                    class="hidden"
                    required
                    @change="previewImage"
                />
            </div>
            <genre-dropdown-component
                @selected-value="(genre) => (genreId = genre)"
            />
            <input
                type="submit"
                value="Submit"
                class="inline-block w-full bg-black py-1 rounded cursor-pointer text-center text-white border border-black hover:bg-white hover:text-black text-input"
            />
        </form>
    </form>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import GenreDropdownComponent from "@/components/genres/GenreDropdownComponent.vue";
const path = ref(
    "http://api.book-management.test:8000/storage/images/default_image.png"
);

const previewImage = (e: Event) => {
    const file = e.target?.files[0];
    path.value = URL.createObjectURL(file);
};

const genreId = ref<number>();
</script>

<style scoped>
.fixed-image {
    height: 400px;
    width: 320px;
}

@media (max-width: 1260px) and (min-width: 1024px) {
    .fixed-image {
        height: 320px;
    }
}

@media (max-width: 425px) {
    .fixed-image {
        height: 265px;
        width: 200px;
    }
}
</style>
