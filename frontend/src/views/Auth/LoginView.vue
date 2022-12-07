<template>
    <div class="h-screen grid place-items-center">
        <section class="relative md:w-1/3 sm:w-2/3 w-5/6">
            <div class="flex justify-center items-center">
                <img src="@/assets/logo.svg" alt="logo" class="absolute" />
            </div>
            <form
                class="guest-form pt-12 pb-8 px-8 border-4 border-black rounded-md"
                method="POST"
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
                        class="w-full p-2"
                        v-model="email"
                    />
                </div>
                <div class="mb-5 input-text">
                    <label for="password" class="text-input">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full p-2"
                        v-model="password"
                    />
                </div>
                <div class="mb-3 input-button-outlined">
                    <input
                        type="submit"
                        value="Submit"
                        class="w-full rounded-lg"
                    />
                </div>
                <div class="w-full flex justify-between">
                    <h1>Don't have an account?</h1>
                    <div>
                        <link-component
                            name="Register"
                            class-style="underline hover:text-gray-700 hover:no-underline"
                            :is-named-link="true"
                            redirect-link="Register"
                        />
                    </div>
                </div>
            </form>
        </section>
    </div>
</template>

<script lang="ts">
import LinkComponent from "@/components/generic/LinkComponent.vue";
export default {
    name: "LoginView",
    data() {
        return {
            email: "",
            password: "",
        };
    },
    components: { LinkComponent },
};
</script>
