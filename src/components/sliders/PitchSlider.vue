<script setup>
import { onMounted, ref, onUnmounted, watch } from 'vue';
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'
import SliderNavBar from './SliderNavBar.vue';
import { useRouter } from 'vue-router';
import PitchCard from '../pitches/PitchCard.vue';

const router = useRouter();

const props = defineProps({
    pitches: {
        type: Array,
        required: true
    },
});

const emit = defineEmits([ 'slide', 'next', 'prev' ]);

const sliderRef = ref();
const slider = ref({
    index: 1,
    slide: 0
});
const perPage = ref(3);
const slideRatio = ref(1/3);

const slideChangeHandler = ( e ) => {
    const { currentSlide } = e;
    slider.value.index = parseInt( currentSlide.index/perPage.value ) + 1;
    slider.value.slide = currentSlide.index;
}

const nextSlide = () => {
    sliderRef.value.goToSlide(slider.value.slide + perPage.value);
}

const prevSlide = () => {
    sliderRef.value.goToSlide(slider.value.slide - perPage.value);
}

const goToSlide = ( slideIndex ) => {
    sliderRef.value.goToSlide( slideIndex*perPage.value + 1 );
}

const handleResize = ( e ) => {
    if ( window.innerWidth <= 600 ) {
        perPage.value = 1;
    } else if ( window.innerWidth <= 992 ) {
        perPage.value = 2;
    } else {
        perPage.value = 4
    }
}

watch( perPage, ( value ) => {
    if ( value == 4 ) {
        slideRatio.value = 1/3;
    } else if ( value == 2 ) {
        slideRatio.value = 0.76
    } else if ( value ==1 ) {
        slideRatio.value = 1.28;
    }
});


onMounted(() => {
    window.addEventListener('resize', handleResize);
    handleResize();
});

onUnmounted(() => {
    window.removeEventListener('resize', handleResize)
})

</script>

<template>
    <VueperSlides 
        class="no-shadow"
        :visible-slides="perPage"
        slide-multiple
        :gap="3"
        :slide-ratio="slideRatio"
        :dragging-distance="200"
        :draggable="true"
        :breakpoints="{ 800: { visibleSlides: perPage, slideMultiple: perPage } }"
        :arrows="false"
        :bullets="false"
        @slide="slideChangeHandler"
        ref="sliderRef"
    >
        <VueperSlide
            v-for="(pitch, i) in pitches"
                :key="i"
                :title="pitch.title"
                class="rounded-xl"
        >
            <template #content>
                <div class="flex">
                    <PitchCard :title="pitch.title" :description="pitch.description" :img="pitch?.images[0]?.src" :pitchId="pitch.id" :is-saved="pitch.is_saved" :features="pitch.features"/>
                </div>
            </template>
        </VueperSlide>
    </VueperSlides>
    <SliderNavBar 
        v-if="pitches.length > perPage"
        :num-slides="Math.ceil( pitches.length/perPage )" 
        :active="slider.index" 
        :per-page="perPage"
        @next="nextSlide"
        @prev="prevSlide"
        @bulletPress="( e ) => goToSlide( e )"
    />
</template>
