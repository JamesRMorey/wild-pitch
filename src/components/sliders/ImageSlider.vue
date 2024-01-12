<script setup>
import { onMounted, ref, onUnmounted, toRefs } from 'vue';
import SliderNavBar from './SliderNavBar.vue';
import { useRouter } from 'vue-router';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';

const router = useRouter();

const props = defineProps({
    images: {
        type: Array,
        required: true
    },
    perPageLg: {
        type: Number,
        required: false,
        default: 4,
    },
    perPageMd: {
        type: Number,
        required: false,
        default: 3,
    },
    perPageSm: {
        type: Number,
        required: false,
        default: 2,
    },
    perPageXs: {
        type: Number,
        required: false,
        default: 1,
    },
    showArrows: {
        type: Boolean,
        required: false,
        default: false
    }
});

const emit = defineEmits([ 'slide', 'next', 'prev' ]);

const { images, perPageLg, perPageMd, perPageSm, perPageXs } = toRefs( props );

const sliderRef = ref();
const slider = ref({
    index: 0,
});
const perPage = ref(perPageLg.value);

const slideChangeHandler = ( e ) => {
    const currentSlide = e;
    sliderRef.value.go( currentSlide );
    slider.value.index = currentSlide;
}

const nextSlide = () => {
    if ( slider.value.index == ( images.value.length - perPage.value ) ) return;

    sliderRef.value.go(slider.value.index + 1);
    slider.value.index += 1;
}

const prevSlide = () => {
    if ( slider.value.index == 0 ) return;

    sliderRef.value.go(slider.value.index - 1);
    slider.value.index -= 1;
}

const goToSlide = ( slideIndex ) => {
    sliderRef.value.go( slideIndex );
}

const handleResize = ( e ) => {
    if ( window.innerWidth < 500 ) {
        perPage.value = perPageXs.value;
    } else if ( window.innerWidth <= 770 ) {
        perPage.value = perPageSm.value;
    } else if ( window.innerWidth <= 992 ) {
        perPage.value = perPageMd.value;
    } else {
        perPage.value = perPageLg.value;
    }
}

onMounted(() => {
    window.addEventListener('resize', handleResize);
    handleResize();

    sliderRef.value.splide.on('moved', slideChangeHandler);
});

onUnmounted(() => {
    window.removeEventListener('resize', handleResize)
})

</script>

<template>
    <Splide 
        :options="{ 
            rewind: true,
            perPage: perPage,
            gap: 20,
            arrows: false,
            pagination: false
        }" 
        ref="sliderRef"
    >
        <SplideSlide
            v-for="(img, i) in images"
            :key="i"
            class="rounded-xl"
        >
            <img :src="img"  class="w-full aspect-square rounded-xl object-cover object-center"/>
        </SplideSlide>
    </Splide>
    <SliderNavBar 
        v-if="images.length > perPage"
        :num-slides="images.length" 
        :active="slider.index" 
        :per-page="perPage"
        @next="nextSlide"
        @prev="prevSlide"
        @bulletPress="( e ) => goToSlide( e )"
        :show-arrows="false"
        class="mt-2"
    />
</template>
