<template>
  <Suspense>
    <template #fallback>
      <is-loading-component />
    </template>
    <template #default>
      <router-view></router-view>
    </template>
  </Suspense>
</template>
<script>
import IsLoadingComponent from "@/components/IsLoadingComponent.vue";
import { computed } from "vue";
import { useRouter } from "vue-router";
import { useStore } from "vuex";
export default {
  setup() {
    const store = useStore();
    const router = useRouter();

    const isLoggedIn = computed(() => store.getters.getIsLoggedIn);

    if (!isLoggedIn) {
      router.push({ name: "Home" });
    }
  },
  components: { IsLoadingComponent },
};
</script>
