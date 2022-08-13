<template>
  <section class="relative md:w-1/3 sm:w-2/3">
    <div class="flex justify-center items-center">
      <img src="@/assets/logo.svg" alt="logo" class="absolute" />
    </div>
    <form
      class="guest-form pt-12 pb-8 px-8 border-4 border-black rounded-md"
      @submit.prevent="login"
    >
      <div class="mb-3 text-header text-center">
        <h1>Login</h1>
      </div>
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
        <input type="submit" value="Submit" class="w-full rounded-lg" />
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
</template>

<script>
export default {
  name: "LoginView",
  data() {
    return {
      email: "",
      password: "",
    };
  },
};
</script>
