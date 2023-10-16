<script setup>
    import { randomInt } from '../../services/Helpers';
    const props = defineProps({
        text: {
            type: String,
            required: false,
            default: "We've got no results! If you know somewhere around here why not add it?"
        }
    })

    const images = [
        '/no-results/nr_1.png',
        '/no-results/nr_2.png',
        '/no-results/nr_3.png',
        '/no-results/nr_4.png',
        '/no-results/nr_5.png',
        '/logos/icon.png'
    ];

    const image = images[randomInt(0, images.length-1)];
</script>

<template>
    <div class="flex-col inline-flex justify-center items-center text-center p-6 gap-5">
        <div class="bg-cover aspect-square bg-no-repeat w-64 md:w-72" :style="{ backgroundImage: `url(${image})`}"></div>
        <div class="text-lg">{{ text }}</div>
    </div>
</template>