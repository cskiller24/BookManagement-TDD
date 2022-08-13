<template>
  <main>
    <section class="h-screen flex flex-col justify-between">
      <div class="container mx-auto">
        <NavigationComponent />
      </div>
      <div class="mb-auto container mx-auto">
        <router-view></router-view>
      </div>
      <div class="h-auto mt-52">
        <FooterComponent />
      </div>
    </section>
  </main>
</template>

<script>
import NavigationComponent from "../components/NavigationComponent.vue";
import FooterComponent from "@/components/FooterComponent.vue";
export default {
  name: "UserLayout",
  components: {
    NavigationComponent,
    FooterComponent,
  },
};
</script>
