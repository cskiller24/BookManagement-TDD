<template>
    <footer class="bg-black text-white h-50 pt-5">
        <div
            class="container mx-auto flex justify-between md:flex-row flex-col md:pl-0 pl-3"
        >
            <div class="text-header md:mb-3 mb-7">
                <router-link :to="{ name: 'Home' }">BookEx</router-link>
            </div>
            <div class="mb-7">
                <div class="text-subHeader md:mb-3 mb-1">References</div>
                <link-component
                    v-for="(mediaLink, index) in mediaLinks"
                    class="text-input"
                    :key="index"
                    :is-named-link="false"
                    :name="mediaLink.name"
                    :redirect-link="mediaLink.link"
                />
            </div>
            <div>
                <div class="text-subHeader mb-1">More BookEX</div>
                <link-component
                    v-for="(refLink, index) in refLinks"
                    class="text-input"
                    :key="index"
                    :is-named-link="false"
                    :name="refLink.name"
                    :redirect-link="refLink.link"
                />
            </div>
        </div>
    </footer>
</template>

<script lang="ts">
import LinkComponent from "@/components/generic/LinkComponent.vue";
export default {
    data() {
        return {
            homelink: { name: "BookEx", link: "/" },
            mediaLinks: [{ name: "Media", link: "/" }],
            refLinks: [
                { name: "Most reviewed", link: "/books?sortBy=reviews" },
                { name: "Top Books", link: "/books?sortBy=favorites" },
                { name: "About", link: "/about" },
            ],
        };
    },
    components: { LinkComponent },
};
</script>
