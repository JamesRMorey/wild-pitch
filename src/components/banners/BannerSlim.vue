<script setup>
import { randomInt } from '../../services/Helpers';
import { slims } from '../../services/Consts';
import { ref } from 'vue';

const props = defineProps({
    title: {
        type: String,
        required: false,
        default: ''
    }
});

const random = ref(randomInt(0, slims.length-1));
const background = slims[random.value];

</script>

<template>
    <div class="w-full inline-flex inline-flex h-64 justify-center items-center bg-center bg-cover" :style="{ backgroundImage: `url(${background})`}">
        <!-- <div class="inline-flex flex-col text-center gap-2 p-8 bg-black rounded-2xl bg-opacity-40"> -->
            <div class="text-3xl font-bold text-white capitalize">{{ title }}</div>
        <!-- </div> -->
    </div>
</template>