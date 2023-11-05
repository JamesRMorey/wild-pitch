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
    <div class="bg-yellow-200 py-3 border-2 border-yellow-700 px-5 rounded-xl inline-flex gap-3 inline-flex items-start">
        <!-- <font-awesome-icon icon="fa-solid fa-exclamation" size="lg" class="mt-1"/> -->
        <div class="text-md text-yellow-700">{{ text }}</div>
    </div>
</template>