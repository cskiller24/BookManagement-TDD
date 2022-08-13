<template>
  <is-loading-component v-if="isLoading" />
  <div class="h-screen grid place-items-center" v-else>
    <section class="relative md:w-1/3 sm:w-2/3">
      <div class="flex justify-center items-center">
        <img src="@/assets/logo.svg" alt="logo" class="absolute" />
      </div>
      <form
        class="guest-form pt-12 pb-8 px-8 border-4 border-black rounded-md"
        method="post"
      >
        <div class="mb-3 text-header text-center">
          <h1>Login</h1>
        </div>
        <errors-component
          :name="pageName"
          class="bg-red-500 py-2 text-center"
          text-class="text-white"
        />
        <div class="mb-3 input-text">
          <label for="email" class="text-input">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            class="w-full"
            v-model="email"
          />
        </div>
        <div class="mb-3">
          <label for="password" class="text-input">Password</label>
          <input
            type="password"
            name="password"
            id="password"
            class="w-full border-2 border-black rounded-sm focus:border-gray-500 focus:outline-none focus:ring-0"
            v-model="password"
          />
        </div>
        <div class="mb-3 input-button-outlined">
          <input
            type="submit"
            value="Submit"
            class="w-full rounded-lg"
            @click.prevent="login"
          />
        </div>
        <div class="w-full flex justify-between">
          <h1>Don't have an account?</h1>
          <div>
            <router-link
              :to="{ name: 'Register' }"
              class="underline hover:text-gray-700 hover:no-underline"
            >
              Register
            </router-link>
          </div>
        </div>
      </form>
    </section>
  </div>
</template>

<script>
import { computed, onMounted, ref } from "vue";
import { setTitle } from "@/helpers/title";
import { useStore } from "vuex";
import { useRoute } from "vue-router";

import ErrorsComponent from "@/components/ErrorsComponent.vue";
import IsLoadingComponent from "@/components/isLoadingComponent.vue";
import router from "@/router";

export default {
  setup() {
    const store = useStore();
    const pageName = useRoute().name;

    const email = ref("");
    const password = ref("");

    const isLoading = computed(() => store.getters.getIsLoading);
    const isLoggedIn = computed(() => store.getters.getIsLoggedIn);

    async function login() {
      store.commit("deleteError", { name: pageName });
      await store.dispatch("AUTH_LOGIN", {
        pageName: pageName,
        email: email.value,
        password: password.value,
      });
    }

    onMounted(() => {
      setTitle("Login");
      if (isLoggedIn.value) {
        console.log(isLoggedIn.value);
        router.push({ name: "Home" });
      }
    });
    return { email, password, login, pageName, isLoading };
  },
  components: { ErrorsComponent, IsLoadingComponent },
};
</script>
