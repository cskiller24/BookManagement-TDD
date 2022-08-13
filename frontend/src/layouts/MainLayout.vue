<template>
  <div class="h-screen flex flex-col justify-between">
    <header class="container mx-auto">
      <nav-component />
    </header>
    <section id="contents" class="mb-auto container mx-auto">
      <router-view></router-view>
    </section>
    <footer class="h-auto mt-52">
      <footer-component />
    </footer>
  </div>
</template>

<script>
import NavComponent from "@/components/NavComponent.vue";
import FooterComponent from "@/components/FooterComponent.vue";

export default {
  setup() {},
  components: { NavComponent, FooterComponent },
};
</script>
