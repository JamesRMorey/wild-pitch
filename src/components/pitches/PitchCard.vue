<script setup>
import CustomButton from '../buttons/CustomButton.vue';

const props = defineProps({
    title: {
        type: String,
        required: false,
        default: 'A pitch'
    },
    description: {
        type: String,
        required: false,
        default: 'An awesome pitch with sea views and views of snowdon, its quite special'
    },
    features: {
        type: Array,
        required: false,
        default: []
    },
    img: {
        type: String,
        required: true,
        default: ''
    },
    pitchId: {
        type: String,
        required: true,
    }
});
</script>

<template>
    <div class="w-full inline-flex flex-col gap-3 justify-center bg-center bg-cover">
        <div class="w-full rounded-xl bg-center bg-cover aspect-square text-right p-4" :style="{ backgroundImage: `url(${img})`}">
            <font-awesome-icon icon="fa-solid fa-heart" size="lg"/>
        </div>
        <div class="inline-flex flex-col">
            <div class="text-lg font-semibold capitalize truncate ...">{{ title }}</div>
            <div class="text-grey truncate ...">{{ description }}</div>
            <router-link :to="'/pitches/pitch/' + pitchId"  class="mt-5 underline text-right">
                view
            </router-link>
        </div>
    </div>
</template>