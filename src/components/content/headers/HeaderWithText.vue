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
    <div class="flex w-full items-start lg:items-center flex-col lg:flex-row gap-5">
        <div>
            <h2 class="text-4xl font-semibold text-green-dark">{{ title }}</h2>
            <div class="h-1 w-full block lg:hidden h-full bg-green-dark rounded-xl mt-5"></div>
        </div>
        <div class="w-1 h-full hidden lg:block bg-green-dark rounded-xl"></div>
        <div class="grow shrink basis-0">{{ text }}</div>
    </div>
</template>