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
    <div class="px-0 px-5 py-10 lg:px-32 lg:py-24 inline-flex gap-3 inline-flex grid lg:grid-cols-2  items-center">
        <div class="px-10 lg:px-5 inline-flex justify-center items-center">
            <div 
                :style="{ backgroundImage: `url(${image})`}"
                class="h-auto sm:h-64 lg:h-auto aspect-video lg:aspect-square w-full bg-cover bg-center rounded-2xl shadow"
            ></div>
        </div>
        <div class="m-10 inline-flex flex-col gap-5">
            <h2 v-if="title" class="text-5xl font-semibold">{{ title }}</h2>
            <div>{{ text }}</div>
        </div>
    </div>
</template>