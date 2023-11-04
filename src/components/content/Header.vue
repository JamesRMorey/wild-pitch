<script setup>

const props = defineProps({
    title: {
        type: String,
        required: false
    },
});

</script>

<template>
    <div class="px-0 w-full md:px-8 xl:px-0 inline-flex inline-flex items-center flex-col md:flex-row text-center md:text-left">
        <h2 class="text-4xl font-semibold w-3/4">{{ title }}</h2>
    </div>
</template>