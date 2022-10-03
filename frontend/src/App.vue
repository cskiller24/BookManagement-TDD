<template>
  <section v-if="isLoading">
    <is-loading-component />
  </section>
  <main v-else>
    <router-view />
  </main>
</template>

<script>
import { useStore } from "vuex";
import { axiosClient } from "@/lib/axios";
import IsLoadingComponent from "@/components/isLoadingComponent.vue";
import { onBeforeMount, ref } from "vue";
import { default as HTPP_STATUS } from "@/helpers/status";
export default {
  setup() {
    const store = useStore();
    const isLoading = ref(true);
    onBeforeMount(async () => {
      await axiosClient
        .get("auth")
        .then(({ status, data }) => {
          if (status === HTPP_STATUS.HTTP_OK) {
            store.commit("setUser", data.data);
          }
        })
        .then(() => {})
        .finally(() => {
          isLoading.value = false;
        });
    });
    return { isLoading };
  },
  components: {
    IsLoadingComponent,
  },
};
</script>
