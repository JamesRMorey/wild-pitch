<script setup>
import LocationSearchBar from '../functional/LocationSearchBar.vue';

const props = defineProps({
    title: {
        type: String,
        required: false
    },
    subTitle: {
        type: String,
        required: false
    }
})

const emit = defineEmits([ 'search' ]);

const handleSearch = ( location ) => {
    emit('search', location);
}

</script>

<template>
    <div class="w-full flex-col gap-12 inline-flex inline-flex py-60 justify-center items-center bg-center bg-cover" style="background-image: url('https://www.visitsnowdonia.info/sites/default/files/styles/home_hero_carousel_1400x600_/public/Llyn%20Llydaw%2C%20Snowdon%20-%20Yr%20Wyddfa%201400%20600.png?itok=QfjqcYiL');">
        <div v-if="title || subTitle" class="inline-flex flex-col text-center gap-2 p-8 bg-black rounded-2xl bg-opacity-40">
            <div class="text-white text-7xl capitalize">{{ title }}</div>
            <div class="text-white text-xl">{{ subTitle }}</div>
        </div>
        <div class="bg-white p-8 shadow rounded-3xl inline-flex flex-col gap-3">
            <div class="text-xl">Where are you going?</div>
            <LocationSearchBar @search="handleSearch"/>
        </div>
    </div>
</template>