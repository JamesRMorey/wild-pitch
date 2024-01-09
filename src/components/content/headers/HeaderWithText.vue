<script setup>

const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: false
    },
});

</script>

<template>
    <div class="inline-flex items-center flex-col md:flex-row gap-5">
            <h2 class="text-4xl font-semibold text-green-dark">{{ title }}</h2>
            <div class="w-1 h-full bg-green-dark rounded-xl"></div>
            <div class="">{{ text }}</div>
        </div>
</template>