<script setup>
import { ref } from 'vue';
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'
import SliderNavBar from './SliderNavBar.vue';
import { useRouter } from 'vue-router';

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
const perPage = ref(4)

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

</script>

<template>
    <VueperSlides 
        class="no-shadow"
        :visible-slides="perPage"
        slide-multiple
        :gap="3"
        :slide-ratio="1 / 4"
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
                <div class="h-full flex flex-col justify-start items-start bg-cover bg-center rounded-xl cursor-pointer group" 
                        @click="() => router.push({ name: 'pitch-show', params: { pitchId: pitch.id } })"
                >
                    <div class="p-4 bg-gray-100 rounded-xl flex flex-col h-full w-full gap-2 group-hover:bg-gray-200 transition-all ease-in-out">
                        <div class="flex bg-cover bg-center rounded-xl w-full flex-col h-full group-hover:brightness-75 transition-all ease-in-out" 
                            :style="{ backgroundImage: `url(${pitch.images[0].src})`}"
                        >
                        </div>
                        <div class="flex justify items-center">
                            <div class="text-md font-semibold truncate h-full ...">{{ pitch.title }}</div>
                        </div>
                    </div>
                </div>
            </template>
        </VueperSlide>
    </VueperSlides>
    <SliderNavBar 
        v-if="pitches.length > perPage"
        :num-slides="pitches.length%perPage" 
        :active="slider.index" 
        :per-page="perPage"
        @next="nextSlide"
        @prev="prevSlide"
        @bulletPress="( e ) => goToSlide( e )"
    />
</template>
