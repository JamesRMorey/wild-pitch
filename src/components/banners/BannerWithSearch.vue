<script setup>
import LocationSearchBar from '../functional/LocationSearchBar.vue';
import { randomInt } from '../../services/Helpers';
import { backgrounds } from '../../services/Consts';
import { ref } from 'vue';

const props = defineProps({
    subTitle: {
        type: String,
        required: false
    }
})

const random = ref(randomInt(0, backgrounds.length-1));
const background = backgrounds[random.value];

const emit = defineEmits([ 'search' ]);

const handleSearch = ( location ) => {
    emit('search', location);
}

</script>

<template>
    <div class="w-full flex-col px-10 md:px-0 gap-12 inline-flex inline-flex py-60 justify-center items-center bg-center bg-cover" :style="{ backgroundImage: `url(${background})`}">
        <div class="inline-flex flex-col text-center gap-2 p-8 rounded-2xl">
            <slot name="content"></slot>
        </div>
        <div class="bg-white p-8 shadow rounded-3xl inline-flex flex-col gap-3 w-full md:w-auto">
            <div class="text-xl">Where are you going?</div>
            <LocationSearchBar @search="handleSearch"/>
        </div>
    </div>
</template>