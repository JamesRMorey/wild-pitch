<script setup>
import { randomInt } from '../../services/Helpers';
import { slims } from '../../services/Consts';
import { ref } from 'vue';

const props = defineProps({
    title: {
        type: String,
        required: false,
        default: ''
    },
    link: {
        type: Object,
        required: false,
    }
});

const random = ref(randomInt(0, slims.length-1));
const background = slims[random.value];

</script>

<template>
    <router-link v-if="link" class="relative group cursor-pointer" :to="link">
        <div
            class="p-5 z-1 w-full inline-flex inline-flex h-64 justify-center items-center bg-center bg-cover transition text-3xl font-bold text-white" 
            tabindex="0" 
            :style="{ backgroundImage: `url(${background})`}"
        >
            <div class="absolute z-10 bg-gray-800 bg-opacity-50 text-white group-hover:bg-opacity-100 shadow group-hover:text-white group-hover:px-10 group-hover:py-3 py-2 px-6 rounded-full transition-all ease-in-out">{{ title }}</div>
        </div>
        <div class="absolute top-0 bottom-2 left-0 right-0 bg-green-light bg-opacity-0 z-0 group-hover:bg-opacity-30 transition-all ease-in-out"></div>
    </router-link>
    <div v-else class="relative" >
        <div
            class="p-5 z-1 w-full inline-flex inline-flex h-64 justify-center items-center bg-center bg-cover transition text-3xl font-bold text-white" 
            tabindex="0" 
            :style="{ backgroundImage: `url(${background})`}"
        >
            <div class="absolute z-10 text-white">{{ title }}</div>
        </div>
    </div>
</template>