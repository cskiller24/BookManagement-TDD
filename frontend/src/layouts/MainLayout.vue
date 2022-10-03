<template>
  <div class="h-screen flex flex-col justify-between">
    <header class="container mx-auto">
      <nav-component />
    </header>
    <section id="contents" class="mb-auto container mx-auto">
      <Suspense>
        <template #fallback>
          <is-loading-component />
        </template>
        <template #default>
          <router-view></router-view>
        </template>
      </Suspense>
    </section>
    <footer class="h-auto">
      <footer-component />
    </footer>
  </div>
</template>

<script>
import NavComponent from "@/components/NavComponent.vue";
import FooterComponent from "@/components/FooterComponent.vue";
import IsLoadingComponent from "@/components/IsLoadingComponent.vue";

export default {
  setup() {},
  components: { NavComponent, FooterComponent, IsLoadingComponent },
};
</script>
