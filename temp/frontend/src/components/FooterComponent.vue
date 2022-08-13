<template>
  <nav class="bg-black text-white h-50">
    <div class="container mx-auto flex justify-between pt-8">
      <div class="text-header">
        <router-link :to="{ name: 'Home' }">BookEx</router-link>
      </div>
      <div>
        <div class="text-subHeader">References</div>
        <p class="text-input">Media</p>
      </div>
      <div>
        <div class="text-subHeader">More BookEX</div>
        <p class="text-input">Most Reviewed</p>
        <p class="text-input">Top Books</p>
        <p class="text-input">About</p>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "FooterComponent",
};
</script>
