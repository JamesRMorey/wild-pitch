<script setup>
import HeaderWithText from './headers/HeaderWithText.vue';


const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: false
    },
    pitches: {
        type: Array,
        required: true
    }
});

</script>

<template>
    <div class="px-0 md:px-8 xl:px-0 inline-flex w-full gap-8 flex-col text-center md:text-left">
        <HeaderWithText :title="title" :text="text" />
        
    </div>
</template>
