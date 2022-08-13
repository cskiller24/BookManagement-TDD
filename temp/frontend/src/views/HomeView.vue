<template>
  <section>
    <div class="grid grid-flow-col justify-between h-full" id="hero-section">
      <div class="">
        <div class="h-full flex items-center">
          <div>
            <h1 class="text-header">Beyond Imagination</h1>
            <h2 class="text-subHeader mb-3 w-4/5">
              A world full of imagination is in your hands - “Books”
            </h2>
            <router-link
              :to="{ name: 'Books' }"
              class="text-subHeader border-2 border-black rounded-full px-4 py-1 my-2 hover:text-white hover:bg-black"
            >
              Explore
            </router-link>
          </div>
        </div>
      </div>
      <div class="flex items-center">
        <img
          src="@/assets/books.svg"
          alt="Books Image"
          class="max-w-full h-full"
        />
      </div>
    </div>
    <section class="mt-24 text-center">
      <h1 class="text-header">Traverse and investigate different genres</h1>
      <div class="grid justify-evenly grid-flow-col mt-5">
        <div>
          <div class="border-8 border-black rounded-2xl px-10 py-3 mb-3">
            <img
              src="@/assets/books/science.svg"
              alt="Science Book"
              class="w-auto h-72"
            />
            <p class="text-subHeader">Science</p>
          </div>
          <router-link
            :to="{ name: 'Genres' }"
            class="text-subHeader border-2 bg-black border-black text-white px-4 py-2 rounded-full hover:text-black hover:bg-white"
          >
            Explore
          </router-link>
        </div>

        <div>
          <div class="border-8 border-black rounded-2xl px-10 py-3 mb-3">
            <img
              src="@/assets/books/history.svg"
              alt="History Book"
              class="w-auto h-72"
            />
            <p class="text-subHeader">History</p>
          </div>
          <router-link
            :to="{ name: 'Genres' }"
            class="text-subHeader border-2 bg-black border-black text-white px-4 py-2 rounded-full hover:text-black hover:bg-white"
          >
            Explore
          </router-link>
        </div>

        <div>
          <div class="border-8 border-black rounded-2xl px-10 py-3 mb-3">
            <img
              src="@/assets/books/romance.svg"
              alt="Romance Book"
              class="w-auto h-72"
            />
            <p class="text-subHeader">Romance</p>
          </div>
          <router-link
            :to="{ name: 'Genres' }"
            class="text-subHeader border-2 bg-black border-black text-white px-4 py-2 rounded-full hover:text-black hover:bg-white"
          >
            Explore
          </router-link>
        </div>
      </div>
    </section>
  </section>
</template>

<script>
export default {
  name: "HomeView",
};
</script>
