<script setup>
const props = defineProps({
    title: {
        type: String,
        required: false,
        default: ''
    }
});
</script>

<template>
    <div class="w-full inline-flex inline-flex h-64 justify-center items-center bg-center bg-cover" style="background-image: url('https://www.visitsnowdonia.info/sites/default/files/styles/home_hero_carousel_1400x600_/public/Llyn%20Llydaw%2C%20Snowdon%20-%20Yr%20Wyddfa%201400%20600.png?itok=QfjqcYiL');">
        <div class="text-3xl font-bold text-white capitalize">{{ title }}</div>
    </div>
</template>