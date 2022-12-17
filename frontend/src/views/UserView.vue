<template>
    <section class="flex justify-center min-h-full">
        <div class="border-4 border-black p-4 rounded-lg w-3/5">
            <h2 class="text-subHeader text-center">User Profile</h2>
            <p>Name: {{ user.name }}</p>
            <p>Email: {{ user.email }}</p>
            <p>Verified: {{ user.is_verified ? "Yes" : "No" }}</p>

            <div class="border-2 border-black p-2 mt-4 rounded">
                <h3 class="text-center text-input">Change password</h3>
                <form method="post">
                    <div class="mb-3">
                        <label for="old_password">Old password</label>
                        <input
                            type="password"
                            id="old_password"
                            class="w-full py-1 px-2 border border-black focus:outline-black rounded"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="new_password">New password</label>
                        <input
                            type="password"
                            id="new_password"
                            class="w-full py-1 px-2 border border-black focus:outline-black rounded"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirm"
                            >Confirm new password</label
                        >
                        <input
                            type="password"
                            id="new_password_confirm"
                            class="w-full py-1 px-2 border border-black focus:outline-black rounded"
                        />
                    </div>
                    <input
                        type="submit"
                        value="Submit"
                        class="border border-black bg-black text-white py-1 text-center w-full rounded hover:text-black hover:bg-white"
                    />
                </form>
            </div>
        </div>
    </section>
</template>

<script lang="ts" setup>
import type IAuthUser from "@/types/IAuthUser";
import { ref } from "vue";

const user = ref<IAuthUser>({
    id: 1,
    name: "Cedy Cadayong",
    email: "admin@example.com",
    is_admin: false,
    is_verified: false,
});
</script>
