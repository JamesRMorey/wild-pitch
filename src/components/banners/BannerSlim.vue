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
    <RouterLink v-if="link" :to="link" class="w-full inline-flex inline-flex h-64 justify-center items-center bg-center bg-cover cursor-pointer hover:text-black transition text-3xl font-bold text-white capitalize" tabindex="0" :style="{ backgroundImage: `url(${background})`}">
        {{ title }}
    </RouterLink>
    <div v-else class="w-full inline-flex inline-flex h-64 justify-center items-center bg-center bg-cover text-3xl font-bold text-white capitalize" tabindex="0" :style="{ backgroundImage: `url(${background})`}">
        {{ title }}
    </div>
</template>