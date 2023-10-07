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
    buttons: {
        type: Array,
        required: false,
        default: []
    }
});

</script>

<template>
    <PageLayout>
        <div class="inline-flex py-8 justify-between items-center">
            <div class="flex-col inline-flex">
                <div v-if="headerText" class="text-3xl inline-flex capitalize">{{ headerText }}</div>
                <div v-if="subtitleText" class="inline-flex">{{ subtitleText }}</div>
            </div>
            <div v-if="buttons.length" class="inline-flex gap-4 items-center">
                <router-link v-for="(button, i) in buttons" :to="button.route" class="inline-flex border rounded-full px-5 py-2 hover:bg-gray-100 cursor-pointer items-center justify-center">
                    {{ button.text }}
                </router-link>
            </div>
        </div>
        <slot></slot>
    </PageLayout>
</template>