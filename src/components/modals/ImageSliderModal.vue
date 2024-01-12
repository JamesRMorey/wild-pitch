<script setup>
import { onMounted, onUnmounted, ref, toRefs } from 'vue';
import { Splide, SplideSlide, SplideTrack } from '@splidejs/vue-splide';

const emit = defineEmits([ 'close' ]);

const props = defineProps({
    images: {
        type: Array,
        required: true,
    },
    openIndex: {
        type: Number,
        required: false,
        default: 0
    }
})

const { images, openIndex } = toRefs( props );

const perPage = ref(5);

const sliderRef = ref();
const trackRef = ref();
const overlayRef = ref();

const slider = ref({
    index: openIndex.value
});

const goToSlide = ( index ) => {
    sliderRef.value.go( index );
    slider.value.index = index;
}

const slideChangeHandler = ( index ) => {
    goToSlide( index );
}

const handleResize = ( e ) => {
    if ( window.innerWidth < 500 ) {
        perPage.value = 3;
    } else if ( window.innerWidth <= 770 ) {
        perPage.value = 3;
    } else if ( window.innerWidth <= 1025 ) {
        perPage.value = 4;
    } else {
        perPage.value = 5
    }
}

const handleOverlayClick = (event) => {
    if (event.target === overlayRef.value) {
        emit('close');
    }
};

onMounted(() => {
    window.addEventListener('resize', handleResize);
    handleResize();
    document.body.style.overflow = 'hidden';
    sliderRef.value.splide.on('moved', slideChangeHandler);
    goToSlide( openIndex.value );
});


onUnmounted(() => {
    window.removeEventListener('resize', handleResize)
    document.body.style.overflow = 'auto';
})

</script>

<template>
    <teleport to='body'>
        <div class="modal flex justify-center items-center" ref="overlayRef" @click="handleOverlayClick">
            <div class="flex mx-auto container items-center justify-center flex-col gap-3 lg:w-3/4 xl:w-1/2">
                <div class="w-full justify-center flex flex-col items-center gap-5 p-10 ">
                    <Splide 
                        :options="{ 
                            rewind: true,
                            perPage: 1,
                            gap: 5,
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
                            <img 
                                :src="img"  
                                class="w-full aspect-square rounded-xl cursor-grab"
                            />
                        </SplideSlide>
                    </Splide>
                    <Splide 
                        :options="{
                            gap: 10,
                            perPage: perPage,
                            arrows: false
                        }" 
                        class="flex justify-center"
                        ref="trackRef"
                    >
                        <SplideSlide
                            v-for="(img, i) in images"
                            :key="i"
                            class="rounded-xl px-1"
                            @click="() => goToSlide( i )"
                        >
                            <img 
                                :src="img"  
                                class="w-full object-cover object-center aspect-square rounded-xl ease-in-out transition-all cursor-pointer"
                                :class="slider.index == i ? 'brightness-50' : ''"
                            >
                        </SplideSlide>
                    </Splide>
                </div>
            </div>
        </div>
    </teleport>
</template>

<style lang="css">
.modal {
    position: fixed;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.8);
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000000;
}
</style>