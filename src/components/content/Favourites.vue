<script setup>
import { onMounted, ref, toRefs } from 'vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import Api from '../../services/Api';
import NoResults from '../functional/NoResults.vue';
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'
import SliderNavBar from '../sliders/SliderNavBar.vue';

const api = new Api();

const props = defineProps({
    limit: {
        type: Number,
        required: false,
        default: 6
    }
});

const { limit } = toRefs(props);

const config = ref({
    loading: true,
    error: 'Oops, well this is embarassing, we don\'t have any favourites to show you.',
    showError: false
});

const favouritePitches = ref([]);

const getFavouritePitches = async () => {
    config.value.loading = true;

    await api.getFavouritePitches( limit )
        .then(( pitches ) => {
            favouritePitches.value = pitches ?? [];
            config.value.loading = false;

            if ( pitches.length == 0 ) {
                config.value.showError = true;
                return;
            }
            config.showError = false;
        })
        .catch(( error ) => {
            config.value.loading = false;
            config.value.showError = true;
        })
}

onMounted(() => {
    getFavouritePitches();
})

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
    console.log(slideIndex)
    sliderRef.value.goToSlide( slideIndex*perPage.value + 1 );
}

</script>

<template>
    <div class="inline-flex inline-flex items-center justify-center w-full">
        <div v-if="config.loading">
            <PulseLoader color="#000000" />
        </div>
        <div v-else-if="config.showError">
            <NoResults :text="config.error" />
        </div>
        <div class="w-full flex flex-col gap-4">
            <VueperSlides 
                class="no-shadow"
                :visible-slides="perPage"
                slide-multiple
                :gap="3"
                :slide-ratio="1 / 6"
                :dragging-distance="200"
                :draggable="true"
                :breakpoints="{ 800: { visibleSlides: perPage, slideMultiple: perPage } }"
                :arrows="false"
                :bullets="false"
                @slide="slideChangeHandler"
                ref="sliderRef"
            >
                <VueperSlide
                    v-for="(pitch, i) in favouritePitches"
                        :key="i"
                        :title="pitch.title"
                        class="rounded-xl"
                >
                    <template #content>
                        <div class="h-full flex justify-center items-center bg-cover bg-center rounded-xl" >
                            <img :src="pitch.images[0].src" class="h-full w-full object-center object-cover rounded-xl hover:brightness-75 transition-all ease-in-out"/>
                        </div>
                    </template>
                </VueperSlide>
            </VueperSlides>
            <SliderNavBar 
                :num-slides="favouritePitches.length%3" 
                :active="slider.index" 
                :per-page="perPage"
                @next="nextSlide"
                @prev="prevSlide"
                @bulletPress="( e ) => goToSlide( e )"
            />
        </div>
    </div>
</template>