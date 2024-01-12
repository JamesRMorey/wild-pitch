<script setup>
import { onMounted, ref, onUnmounted, toRefs } from 'vue';
import SliderNavBar from './SliderNavBar.vue';
import { useRouter } from 'vue-router';
import PitchCard from '../pitches/PitchCard.vue';
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';

const router = useRouter();

const props = defineProps({
    pitches: {
        type: Array,
        required: true
    },
});

const emit = defineEmits([ 'slide', 'next', 'prev' ]);

const { pitches } = toRefs( props );

const sliderRef = ref();
const slider = ref({
    index: 0,
});
const perPage = ref(3);

const slideChangeHandler = ( e ) => {
    const currentSlide = e;
    sliderRef.value.go( currentSlide );
    slider.value.index = currentSlide;
}

const nextSlide = () => {
    if ( slider.value.index == ( pitches.value.length - perPage.value ) ) return;

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
        perPage.value = 1;
    } else if ( window.innerWidth <= 770 ) {
        perPage.value = 2;
    } else if ( window.innerWidth <= 992 ) {
        perPage.value = 3;
    } else {
        perPage.value = 4
    }
}

onMounted(() => {
    window.addEventListener('resize', handleResize);
    handleResize();
    // Check if you are using the correct ref in your methods
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
            gap: 30,
            arrows: false,
            bullets: false,
            pagination: false
        }" 
        aria-label="Vue Splide Example"
        ref="sliderRef"
    >
        <SplideSlide
            v-for="(pitch, i) in pitches"
            :key="i"
            :title="pitch.title"
            class="rounded-xl"
        >
            <PitchCard :title="pitch.title" :description="pitch.description" :img="pitch?.images[0]?.src" :pitchId="pitch.id" :is-saved="pitch.is_saved" :features="pitch.features"/>
        </SplideSlide>
    </Splide>
    <SliderNavBar 
        v-if="pitches.length > perPage"
        :num-slides="pitches.length" 
        :active="slider.index" 
        :per-page="perPage"
        @next="nextSlide"
        @prev="prevSlide"
        @bulletPress="( e ) => goToSlide( e )"
    />
</template>
