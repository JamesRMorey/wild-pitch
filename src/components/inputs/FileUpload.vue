<script setup>
import { ref, toRefs } from 'vue';

const props = defineProps({
    text: {
        type: String,
        required: false,
        default: 'Drag and drop files or click '
    },
    error: {
        type: String,
        required: false
    },
    acceptedMimeTypes: {
        type: String,
        required: false,
        default: 'image/jpeg, image/webp, image/png'
    }
});

const emit = defineEmits([ 'upload' ]);

const { acceptedMimeTypes } = toRefs( props );

const isDragging = ref(false);

const handleUploadFiles = ( event ) => {
    const files = event.target.files;
    emit('upload', files );
}

const handleDropFiles = ( event ) => {
    const files = event.dataTransfer.files;
    isDragging.value = false;
    emit('upload', files );
}
</script>

<template>
    <div class="inline-flex flex-col w-full border-gray-200 border-2 border-dashed rounded-3xl px-10 md:px-24 py-10 justify-center hover:bg-gray-100 gap-5"
        :class="[ isDragging ? 'bg-gray-100' : '', error ? 'border-red-400' : '']"
        @dragover.prevent="isDragging = true"
        @dragleave="isDragging = false"
        @drop.prevent="handleDropFiles"
    >
        <div class="inline-flex justify-center">
            <font-awesome-icon icon="fa-solid fa-upload" size="xl" class="border border-gray-400 p-3 inline rounded-xl border-dashed"/>
        </div>
        <div class="text-gray-400 text-center">{{ text }}<label class="underline font-semibold text-gray-700 cursor-pointer" for="images">here</label> to upload.</div>
        <input id="images" name="images" type="file" ref="imagesInput" multiple hidden @change="handleUploadFiles" :accept="acceptedMimeTypes"/>
        <div v-if="error" class="text-md text-red-400 text-center">{{ error }}</div>
    </div>
</template>