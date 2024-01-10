<script setup>
import LocationSearchBar from '../functional/LocationSearchBar.vue';

const props = defineProps({
    subTitle: {
        type: String,
        required: false
    },
    background: {
        type: String,
        required: true,
        default: 'backgrounds/background_3.webp'
    }
})

const emit = defineEmits([ 'search' ]);

const handleSearch = ( location ) => {
    emit('search', location);
}

</script>

<template>
    <div class="w-full flex-col px-10 md:px-0 gap-12 inline-flex inline-flex py-16 lg:py-32 justify-center items-center bg-center bg-cover" :style="{ backgroundImage: `url(${background})`}">
        <div class="inline-flex flex-col text-center gap-2 p-8 rounded-2xl">
            <slot name="content"></slot>
        </div>
        <div class="bg-white p-8 shadow rounded-3xl inline-flex flex-col gap-3 w-full md:w-auto">
            <div class="text-xl">Where are you going?</div>
            <LocationSearchBar @search="handleSearch"/>
        </div>
    </div>
</template>