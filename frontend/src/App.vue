<template>
  <router-view />
</template>

<script>
import { onMounted, ref } from "vue";
import { useStore } from "vuex";
import { axiosClient } from "@/lib/axios";

export default {
  setup() {
    const store = useStore();
    onMounted(async () => {
      store.commit("setIsLoading", true);
      await axiosClient
        .get("/auth")
        .then((res) => {
          if (res.status === 200) {
            store.commit("setUser");
          }
        })
        .catch((err) => {})
        .finally(() => {
          store.commit("setIsLoading", false);
        });
    });
    const isLoading = ref(true);

    return { isLoading };
  },
};
</script>
