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
    <div class="text-md text-red-400">
        {{ text }}
    </div>
</template>