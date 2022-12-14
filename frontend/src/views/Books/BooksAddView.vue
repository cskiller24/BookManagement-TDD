<template>
    <!-- <section class="flex justify-center">
        <div
            class="border-2 border-black rounded-md p-2 w-11/12 mx-auto lg:w-3/5 md:mx-0"
        >
            <h2 class="text-subHeader text-center">Add book</h2>
            <form
                method="post"
                class="grid grid-cols-1 gap-2"
                enctype="multipart/form-data"
            >
                <div>
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="w-full border border-black rounded px-2 py-1 focus:outline-black focus:border-black"
                        required
                    />
                </div>
                <div>
                    <label for="description">Description</label>
                    <textarea
                        class="w-full border-black border rounded p-1"
                        rows="6"
                    ></textarea>
                </div>
            </form>
        </div>
    </section> -->

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
const path = ref(
    "http://api.book-management.test:8000/storage/images/default_image.png"
);

const previewImage = (e: Event) => {
    const file = e.target?.files[0];
    path.value = URL.createObjectURL(file);
};
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
