<script setup>

const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    image: {
        type: String,
        required: true
    },
    title: {
        type: String,
        required: false
    }
});

</script>

<template>
    <div class="px-0 lg: px-32 py-24 inline-flex gap-3 inline-flex grid grid-cols-1 lg:grid-cols-2 items-center">
        <div 
            :style="{ backgroundImage: `url(${image})`}"
            class="aspect-square w-full bg-cover bg-center rounded-2xl shadow"
        ></div>
        <div class="m-10 inline-flex flex-col gap-5 bg-gray-100 p-10 shadow rounded-3xl">
            <h2 v-if="title" class="text-5xl font-semibold text-gray-500">{{ title }}</h2>
            <div>{{ text }}</div>
        </div>
    </div>
</template>