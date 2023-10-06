<script setup>
import LocationSearchBar from '../functional/LocationSearchBar.vue';

const emit = defineEmits([ 'search' ]);

const handleSearch = ( location ) => {
    emit('search', location);
}

</script>

<template>
    <div class="w-full inline-flex inline-flex py-60 justify-center items-center bg-center bg-cover" style="background-image: url('https://www.visitsnowdonia.info/sites/default/files/styles/home_hero_carousel_1400x600_/public/Llyn%20Llydaw%2C%20Snowdon%20-%20Yr%20Wyddfa%201400%20600.png?itok=QfjqcYiL');">
        <div class="bg-white p-8 shadow rounded-3xl inline-flex flex-col gap-3">
            <div class="text-xl">Where are you going?</div>
            <LocationSearchBar @search="handleSearch"/>
        </div>
    </div>
</template>