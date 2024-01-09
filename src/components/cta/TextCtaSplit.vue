<script setup>
import LargeButton from '../buttons/LargeButton.vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    text: {
        type: String,
        required: false
    },
    cta1: {
        type: Object,
        required: false
    },
    cta2: {
        type: Object,
        required: false
    },
})

</script>

<template>
    <div class="bg-gray-800 px-12 py-16 rounded-3xl flex justify-between">
        <div class="flex-col">
            <div class="text-green text-3xl font-bold">
                {{ title }}
            </div>
            <div v-if="text" class="text-white text-lg">
                {{ text }}
            </div>
        </div>
        <div class="flex items-center gap-5">
            <LargeButton v-if="cta1" :text="cta1.text" @press="() => router.push( cta1.link )" />
            <LargeButton v-if="cta2" :text="cta2.text" @press="() => router.push( cta2.link )" type="secondary" />
        </div>
    </div>
</template>