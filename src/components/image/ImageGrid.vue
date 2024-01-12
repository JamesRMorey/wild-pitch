<script setup>
import { toRefs, ref, computed } from 'vue';
import ImageSlider from '../sliders/ImageSlider.vue';
import ImageSliderModal from '../modals/ImageSliderModal.vue';

const showMore = ref(false)

const props = defineProps({
    images: {
        type: Array,
        required: true,
    },
});

const { images } = toRefs( props );

const thumbnail = computed(() => {
    if ( images && images.value && images.value.length > 0 ) {
        return images.value[0];
    }

    return ''
});

const otherImages = computed(() => {
    if ( images && images.value && images.value.length > 0 ) {
        return images?.value.slice(1, 5);
    }

    return [];
});

const slider = ref({
    show: false,
    index: 0
});

</script>

<template>
    <div class="w-full flex-col md:grid md:grid-cols-2 gap-3 hidden md:inline-flex">
        <img v-if="thumbnail" :src="thumbnail" class="w-full rounded-xl overflow-hidden object-center object-cover aspect-square text-right cursor-pointer hover:brightness-75 transition-all ease-in-out" @click="() => slider = { show: true, index: 0 }"/>
        <div v-else class="w-full bg-gray-100 rounded-xl overflow-hidden object-center object-cover aspect-square text-right cursor-pointer hover:brightness-75 transition-all ease-in-out"></div>
        <div class="hidden md:grid grid-cols-2 gap-3">
            <img v-if="images?.length > 0" v-for="(image, i) in otherImages" :src="image" loading="lazy" class="w-full rounded-xl object-cover object-center aspect-square relative cursor-pointer hover:brightness-50 transition-all ease-in-out" @click="() => slider = { show: true, index: i+1 }"/>
            <div v-else v-for="i in 4"  class="w-full bg-gray-100 rounded-xl object-cover object-center aspect-square relative cursor-pointer hover:brightness-50 transition-all ease-in-out"></div>
        </div>
    </div>
    <div class="block md:hidden">
        <ImageSlider
            v-if="images"
            :images="images"
            :per-page-lg="4"
            :per-page-md="3"
            :per-page-sm="2"
            :per-page-xs="1"
        />
    </div>
    <ImageSliderModal
        v-if="slider.show"
        :images="images"
        @close="slider.show = false"
        :open-index="slider.index"
    />
</template>