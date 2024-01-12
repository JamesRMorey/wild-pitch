<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import CustomButton from '../buttons/CustomButton.vue';

const emit = defineEmits([ 'confirm', 'close' ]);

const props = defineProps({
    confirmText: {
        type: String,
        required: false
    },
    loading: {
        type: Boolean,
        required: false,
        default: false
    },
    showClose: {
        type: Boolean,
        required: false,
        default: true
    }
})

const overlayRef = ref(null);

const handleConfirm = () => {
    emit('confirm');
}

const handleClose = () => {
    emit('close');
}

const handleOverlayClick = (event) => {
    if (event.target === overlayRef.value) {
        handleClose();
    }
};

onMounted(() => {
    document.body.style.overflow = 'hidden';
})

onUnmounted(() => {
    document.body.style.overflow = 'auto';
})
</script>

<template>
    <teleport to='body'>
        <div class="mx-auto container modal p-5 lg:p-60" ref="overlayRef" @click="handleOverlayClick">
            <div class="bg-white p-10 rounded-2xl inline-flex flex-col gap-3">
                <slot name="title"></slot>
                <slot name="content"></slot>
                <div v-if="confirmText || showClose" class="inline-flex flex-row justify-end gap-3 mt-4">
                    <custom-button v-if="confirmText" :text="confirmText" @press="handleConfirm" :loading="loading"/>
                    <custom-button v-if="showClose" text="close" @press="handleClose"/>
                </div>
            </div>
        </div>
    </teleport>
</template>

<style lang="css">
.modal {
    position: fixed;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.8);
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000000;
}
</style>