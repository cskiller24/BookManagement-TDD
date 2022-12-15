<template>
    <section>
        <label for="genre">Genres</label>
        <select
            name="genre"
            id="genre"
            class="w-full text-center border border-black py-2 rounded cursor-pointer"
            v-model="selected"
            @change="selectedValue"
            required
        >
            <option value="0" disabled selected>Select Genre</option>
            <option :value="genre.id" v-for="genre in genres" :key="genre.id">
                {{ genre.title }}
            </option>
        </select>
    </section>
</template>

<script lang="ts" setup>
import genre from "@/tests/genre";
import type { IGenre } from "@/types/IGenre";
import { computed, ref } from "vue";

const genres = computed<IGenre[]>(() => genre);

const selected = ref<number>(0);

const emits = defineEmits(["selectedValue"]);

const selectedValue = (): void => {
    emits("selectedValue", selected.value);
};
</script>
