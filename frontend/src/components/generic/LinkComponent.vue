<template>
    <div @click="emit('routerClick')">
        <div v-if="isNamedLink">
            <router-link :to="{ name: redirectLink }" :class="classStyle">
                {{ name }}
            </router-link>
        </div>
        <div v-else>
            <router-link :to="redirectLink" :class="classStyle">{{
                name
            }}</router-link>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { RouterLink } from "vue-router";

const emit = defineEmits(["routerClick"]);

defineProps({
    classStyle: {
        type: String,
    },
    redirectLink: {
        type: String,
        required: true,
    },
    isNamedLink: {
        type: Boolean,
        default: false,
    },
    name: {
        type: String,
        required: true,
    },
});
</script>
