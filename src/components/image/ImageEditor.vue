<script setup>
import { ref } from 'vue';
import { Cropper } from 'vue-advanced-cropper';
import 'vue-advanced-cropper/dist/style.css';
import CustomButton from '../buttons/CustomButton.vue';
import IconButton from '../buttons/IconButton.vue';
import Modal from '../modals/Modal.vue';

const emit = defineEmits([ 'close', 'save' ]);

const props = defineProps({
    src: {
        type: String,
        required: true,
    },
    show: {
        type: Boolean,
        required: true,
    }
});

const cropperRef = ref();

const crop = ref({
    image: null,
    width: null,
    height: null
})

const handleClose = () => {
    crop.value = {
        image: null,
        width: null,
        height: null
    }  
    emit('close');
}

const rotateLeft = () => {
    cropperRef.value.rotate(-90)
}

const rotateRight = () => {
    cropperRef.value.rotate(90)
}

const flip = () => {
    cropperRef.value.flip(true, false);
}

const resetImage = () => {
    cropperRef.value.reset()
}

const handleCrop = () => {
    const { canvas, coordinates } = cropperRef.value.getResult();
    const image = canvas.toDataURL();
    crop.value = {
        image: image,
        width: coordinates.width,
        height: coordinates.height
    };
}

const save = () => {
    if ( !crop.value.image ) return;
    emit( 'save', crop.value );
}

</script>

<template>
    <Modal @close="handleClose" :showClose="false">
        <template v-slot:content>
            <div>
                <div class="justify-between w-full inline-flex items-center gap-10 mb-5">
                    <div class="text-2xl">
                        We like squares, please :)
                    </div>
                    <div class="inline-flex justify-end items-center p-4 bg-gray-100 rounded-xl gap-3">
                        <IconButton @press="() => resetImage()" icon="fa-image" class="bg-white"/>
                        <IconButton @press="() => flip()" icon="fa-right-left" class="bg-white"/>
                        <IconButton @press="() => rotateRight()" icon="fa-rotate-right" class="bg-white"/>
                        <IconButton @press="() => rotateLeft()" icon="fa-rotate-left" class="bg-white"/>
                        <IconButton @press="handleCrop" icon="fa-crop" class="bg-white"/>
                    </div>
                </div>
                <div class="relative max-h-[100%] max-w-[75vw]">
                    <div v-if="crop.image" class="absolute z-10 right-5 bottom-5 inline-flex border-dashed border-2 border-white">
                        <img :src="crop.image" class="h-32 w-auto object-cover object-center"/>
                        <div class="bg-black bg-opacity-50 p-2 flex flex-col justify-between">
                            <span class="text-white">
                                <div v-text="'Width: ' + crop.width +'px'"></div>
                                <div v-text="'Height: ' + crop.height +'px'"></div>
                            </span>
                            <CustomButton text="Save" @press="save" />
                        </div>
                    </div>
                    <div class="h-96 self-stretch">
                        <div class="h-full">
                            <Cropper
                            class="cropper"
                            :src="src"
                            :stencil-props="{
                                aspectRatio: 1/1
                            }"
                            
                            ref="cropperRef"
                        />  
                        </div>
                    </div>  
                </div>    
            </div>
        </template>
    </Modal>
</template>