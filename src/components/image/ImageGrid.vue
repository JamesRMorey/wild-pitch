<script setup>
import { toRefs, ref } from 'vue';
import ImageSlider from '../sliders/ImageSlider.vue';

const showMore = ref(false)

const props = defineProps({
    images: {
        type: Array,
        required: true,
    },
});

const { images } = toRefs( props );

const thumbnail = images.value[0];
const otherImages = images.value.slice(1, 5);

</script>

<template>
    <div class="w-full flex-col md:grid md:grid-cols-2 gap-3 hidden md:inline-flex">
        <img :src="thumbnail" class="w-full rounded-xl overflow-hidden object-center object-cover aspect-square text-right" />
        <div class="hidden md:grid grid-cols-2 gap-3">
            <img v-for="(image, i) in otherImages" :src="image" loading="lazy" class="w-full rounded-xl bg-center bg-cover aspect-square relative" />
        </div>
    </div>
    <div class="block md:hidden">
        <ImageSlider
            :images="images"
            :per-page-lg="4"
            :per-page-md="3"
            :per-page-sm="2"
            :per-page-xs="1"
        />
    </div>
</template>