<template>
    <div class="h-screen grid place-items-center">
        <section class="relative md:w-1/3 sm:w-2/3">
            <div class="flex justify-center items-center">
                <img
                    src="@/assets/logo.svg"
                    alt=""
                    srcset=""
                    class="absolute"
                />
            </div>
            <form
                method="post"
                class="border-4 border-black pt-10 pb-8 px-8 w-full rounded-lg"
            >
                <div class="mb-3 text-header text-center">Register</div>
                <div class="mb-3 input-text">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        class="w-full p-2"
                        v-model="name"
                        id="name"
                    />
                </div>
                <div class="mb-3 input-text">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        class="w-full p-2"
                        v-model="email"
                        id="email"
                    />
                </div>
                <div class="mb-3 input-text">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        class="w-full p-2"
                        v-model="password"
                        id="password"
                    />
                </div>
                <div class="mb-3 input-text">
                    <label for="password_confirm">Confirm Password</label>
                    <input
                        type="password"
                        class="w-full p-2"
                        v-model="password_confirmation"
                        id="password_confirm"
                    />
                </div>
                <div class="mb-3 input-button-outlined">
                    <input type="submit" value="Register" class="w-full" />
                </div>
                <div class="flex justify-between">
                    <h1 class="text-body">Already registered?</h1>
                    <div>
                        <link-component
                            name="Login"
                            classStyle="underline hover:text-gray-700 hover:no-underline"
                            :is-named-link="true"
                            redirect-link="Login"
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
    setup() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
        };
    },
    components: { LinkComponent },
};
</script>
