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
    <div class="bg-green-100 py-3 px-5 rounded-xl inline-flex gap-3 inline-flex items-center">
        <font-awesome-icon icon="fa-solid fa-exclamation" size="lg"/>
        <div class="text-md text-gray-500">{{ text }}</div>
    </div>
</template>