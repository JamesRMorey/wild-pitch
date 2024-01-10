<script setup>
const props = defineProps({
    text: {
        type: String,
        required: false,
        default: "We've got no results! If you know somewhere around here why not add it?"
    }
});

const image = '/backgrounds/square/square_2.webp'

</script>

<template>
    <div class="flex-col inline-flex justify-center items-center text-center p-6 gap-8">
        <div class="bg-gray-100 rounded-full p-2">
            <div class="bg-cover aspect-square bg-no-repeat w-64 md:w-72 rounded-full" :style="{ backgroundImage: `url(${image})`}"></div>
        </div>
        <div class="bg-gray-800 text-white px-6 py-2 rounded-full">
            <div class="text-lg">{{ text }}</div>
        </div>
    </div>
</template>