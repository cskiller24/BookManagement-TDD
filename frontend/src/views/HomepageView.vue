<template>
    <main>
        <section
            class="grid md:grid-flow-col justify-between h-full grid-flow-row"
            id="hero-section"
        >
            <div>
                <div class="h-full flex justify-center items-center">
                    <div>
                        <div class="mb-2">
                            <h1 class="text-header md:text-left text-center">
                                Beyond Imagination
                            </h1>
                            <h2
                                class="text-subHeader mb-3 md:w-4/5 md:text-left text-center w-full"
                            >
                                A world full of imagination is in your hands -
                                “Books”
                            </h2>
                        </div>
                        <link-component
                            name="Books"
                            class="md:text-left text-center"
                            :is-named-link="false"
                            redirect-link="/books"
                            class-style="text-subHeader border-2 bg-black border-black text-white px-4 py-2 rounded-full hover:text-black hover:bg-white "
                        />
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <img
                    src="@/assets/books.svg"
                    alt="Books Image"
                    class="max-w-full md:h-full h-3/4"
                />
            </div>
        </section>
        <section class="mt-24 text-center" id="genre-section">
            <h1 class="text-header">
                Traverse and investigate different genres
            </h1>
            <div
                class="grid justify-evenly md:grid-flow-col mt-5 grid-flow-row"
            >
                <div class="mb-7">
                    <div
                        class="border-8 border-black rounded-2xl px-10 py-3 mb-4"
                    >
                        <img
                            src="@/assets/books/science.svg"
                            alt="Science Book"
                            class="w-auto h-72"
                        />
                        <p class="text-subHeader">Science</p>
                    </div>
                    <link-component
                        name="Explore"
                        :is-named-link="false"
                        redirect-link="/genres"
                        class-style="text-subHeader border-2 bg-black border-black text-white px-4 py-2 rounded-full hover:text-black hover:bg-white"
                    />
                </div>

                <div class="mb-7">
                    <div
                        class="border-8 border-black rounded-2xl px-10 py-3 mb-4"
                    >
                        <img
                            src="@/assets/books/history.svg"
                            alt="History Book"
                            class="w-auto h-72"
                        />
                        <p class="text-subHeader">History</p>
                    </div>
                    <link-component
                        name="Explore"
                        :is-named-link="false"
                        redirect-link="/genres"
                        class-style="text-subHeader border-2 bg-black border-black text-white px-4 py-2 rounded-full hover:text-black hover:bg-white"
                    />
                </div>

                <div class="mb-7">
                    <div
                        class="border-8 border-black rounded-2xl px-10 py-3 mb-4"
                    >
                        <img
                            src="@/assets/books/romance.svg"
                            alt="Romance Book"
                            class="w-auto h-72"
                        />
                        <p class="text-subHeader">Romance</p>
                    </div>
                    <link-component
                        name="Explore"
                        :is-named-link="false"
                        redirect-link="/genres"
                        class-style="text-subHeader border-2 bg-black border-black text-white px-4 py-2 rounded-full hover:text-black hover:bg-white"
                    />
                </div>
            </div>
        </section>
    </main>
</template>

<script lang="ts">
import LinkComponent from "@/components/generic/LinkComponent.vue";
export default {
    components: { LinkComponent },
};
</script>
