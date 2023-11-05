<script setup>
import { onMounted, toRefs } from 'vue';

const props = defineProps({
    message: {
        type: Object,
        required: true
    }
})

const { message } = toRefs( props );

const emit = defineEmits(['remove']);

onMounted(() => {
    setTimeout(() => {
        emit('remove');
    }, message.value.time ?? 10000)
})

</script>

<template>
        <div
            class="py-4 px-8 rounded-3xl inline-flex flex-col gap-1 shadow border-2 transition"
            :class="message.type == 'success' ? 'bg-green-200 text-green-700 border-green-700' : 'bg-red-200 text-red-700 border-red-700'"
        >
            <div class="inline-flex justify-between items-start gap-6">
                <div class="text-xl font-semibold capitalize">{{ message.title }}</div>
                <font-awesome-icon icon="fa-solid fa-close" size="xl" class="cursor-pointer" @click="() => emit('remove')"></font-awesome-icon>
            </div>
           <div>{{ message.message }}</div>
        </div>
</template>