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
        <div class="modal flex justify-center items-center p-10" ref="overlayRef" @click="handleOverlayClick">
            <div class="flex  items-center justify-center flex-col gap-3">
                <div class="justify-center mx-auto container flex flex-col items-center gap-5 w-full md:w-3/4 xl:h-[75vh] xl:w-auto aspect-square">
                    <Splide 
                        :options="{ 
                            rewind: true,
                            perPage: 1,
                            gap: 5,
                            arrows: true,
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
                                class="w-full aspect-square rounded-xl cursor-grab object-center object-cover"
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