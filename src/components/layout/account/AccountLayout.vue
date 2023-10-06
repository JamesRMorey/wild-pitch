<script setup>
import PageLayout from '../PageLayout.vue';

const props = defineProps({
    headerText: {
        type: String,
        required: false
    },
    subtitleText: {
        type: String,
        required: false
    },
});

</script>

<template>
    <PageLayout>
        <div class="py-8 flex-col inline-flex">
            <div v-if="headerText" class="text-3xl inline-flex capitalize">{{ headerText }}</div>
            <div v-if="subtitleText" class="inline-flex">{{ subtitleText }}</div>
        </div>
        <slot></slot>
    </PageLayout>
</template>