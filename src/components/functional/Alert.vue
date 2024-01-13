<script setup>

const props = defineProps({
    text: {
        type: String,
        required: false,
        default: 'Oops, there\'s been an error'
    }
});

</script>

<template>
    <div class="bg-gray-800 py-3 border-2 border-gray-900 px-5 rounded-xl inline-flex gap-3 inline-flex items-start">
        <div class="text-md text-white">{{ text }}</div>
    </div>
</template>