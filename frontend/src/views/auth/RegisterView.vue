<template>
  <is-loading-component v-if="isLoading" />
  <div class="h-screen grid place-items-center" v-else>
    <section class="relative md:w-1/3 sm:w-2/3">
      <div class="flex justify-center items-center">
        <img src="@/assets/logo.svg" alt="" srcset="" class="absolute" />
      </div>
      <form
        method="post"
        class="border-4 border-black pt-10 pb-8 px-8 w-full rounded-lg"
        @submit.prevent="register"
      >
        <div class="mb-3 text-header text-center">Register</div>
        <errors-component
          :name="pageName"
          class="bg-red-500 py-2 text-center"
          text-class="text-white"
        />
        <div class="mb-3 input-text">
          <label for="name">Name</label>
          <input type="text" class="w-full" v-model="name" />
        </div>
        <div class="mb-3 input-text">
          <label for="email">Email</label>
          <input type="email" class="w-full" v-model="email" />
        </div>
        <div class="mb-3 input-text">
          <label for="password">Password</label>
          <input type="password" class="w-full" v-model="password" />
        </div>
        <div class="mb-3 input-text">
          <label for="password_confirm">Confirm Password</label>
          <input
            type="password"
            class="w-full"
            v-model="password_confirmation"
          />
        </div>
        <div class="mb-3 input-button-outlined">
          <input type="submit" value="Register" class="w-full" />
        </div>
        <div class="flex justify-between">
          <h1 class="text-body">Already registered?</h1>
          <div>
            <router-link
              :to="{ name: 'Login' }"
              class="underline hover:text-gray-700 hover:no-underline"
            >
              Login
            </router-link>
          </div>
        </div>
      </form>
    </section>
  </div>
</template>

<script>
import { onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStore } from "vuex";
import ErrorsComponent from "@/components/ErrorsComponent.vue";
import IsLoadingComponent from "@/components/isLoadingComponent.vue";
import { setTitle } from "@/helpers/title";

export default {
  setup() {
    const name = ref("");
    const email = ref("");
    const password = ref("");
    const password_confirmation = ref("");

    const store = useStore();
    const pageName = useRoute().name;
    const isLoading = ref(false);

    const register = async () => {
      isLoading.value = true;
      store.commit("deleteError", { name: pageName });

      await store.dispatch("AUTH_REGISTER", {
        pageName: pageName,
        name: name.value,
        email: email.value,
        password: password.value,
        password_confirmation: password_confirmation.value,
      });

      isLoading.value = false;
    };
    setTitle("Register");
    return {
      name,
      email,
      password,
      password_confirmation,
      register,
      pageName,
      isLoading,
    };
  },
  components: { ErrorsComponent, IsLoadingComponent },
};
</script>
