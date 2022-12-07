<template>
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
</template>

<script lang="ts">
export default {
    props: {
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
    },
};
</script>
