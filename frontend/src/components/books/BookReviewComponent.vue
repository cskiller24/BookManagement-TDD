<template>
    <div class="bg-slate-300 p-2 border-black border rounded-md">
        <div class="flex justify-between">
            <p>{{ props.user.name }}</p>
            <p>Rating: {{ props.star }}</p>
        </div>
        <hr class="border-black my-2" />
        <div class="font-bold text-lg">{{ props.title }}</div>
        <div>{{ props.description }}</div>
    </div>
</template>

<script lang="ts" setup>
import type { IReviews } from "@/types/IReviews";

const props = defineProps<IReviews>();
</script>
