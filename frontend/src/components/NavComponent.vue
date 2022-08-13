<template>
  <div class="container mx-auto bg-white flex justify-between py-4">
    <router-link :to="{ name: 'Home' }">
      <section class="flex flex-row justify-center items-center" id="logo">
        <img src="@/assets/logo.svg" class="w-auto h-12 pr-1" />
        <h1 class="text-header center">BookEx</h1>
      </section>
    </router-link>
    <nav class="flex justify-evenly items-center space-x-12">
      <router-link :to="{ name: 'About' }" class="px-4 py-3">
        About
      </router-link>
      <router-link :to="{ name: 'Books' }" class="px-4 py-3">
        Books
      </router-link>
      <router-link :to="{ name: 'Genres' }" class="px-4 py-3">
        Genre
      </router-link>
      <router-link :to="{ name: 'MyBooks' }" class="px-4 py-3">
        My Books
      </router-link>
    </nav>
    <section id="login-section" class="flex flex-row items-center space-x-4">
      <div class="text-input">
        <router-link :to="{ name: 'Login' }">Login</router-link>
      </div>
      <div class="text-input">
        <router-link :to="{ name: 'Register' }" active-class="active">
          Register
        </router-link>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  setup() {},
};
</script>
