<template>
    <div v-if="errors.length != 0">
        <div v-for="error in errors">
            <p :class="textClass">{{ error.message }}</p>
        </div>
    </div>
</template>

<script>
import { computed } from "vue";
import { useStore } from "vuex";

export default {
    props: {
        name: String,
        textClass: String,
    },
    setup(props) {
        const store = useStore();

        const errors = computed(() => {
            return store.getters.getError(props.name);
        });

        return { errors };
    },
};
</script>
