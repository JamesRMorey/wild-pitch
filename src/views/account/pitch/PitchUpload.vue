<script setup>
import AccountLayout from '../../../components/layout/account/AccountLayout.vue';
import FileUpload from '../../../components/inputs/FileUpload.vue';
import { ref, onMounted } from 'vue';
import { VueDraggableNext } from 'vue-draggable-next'
import Api from '../../../services/Api';
import { useRouter } from 'vue-router';
import { base64ToFile, getAspectRatio, getMimeTypeAndExtensionFromBase64, UUID } from '../../../services/Helpers';
import Map from '../../../components/pitches/Map.vue';
import ErrorText from '../../../components/functional/ErrorText.vue';
import CustomButton from '../../../components/buttons/CustomButton.vue';
import TextInput from '../../../components/inputs/TextInput.vue';
import TextAreaInput from '../../../components/inputs/TextAreaInput.vue';
import { useAppStore } from '../../../stores/app';
import ImageEditor from '../../../components/image/ImageEditor.vue';

const api = new Api();
const router = useRouter();
const appStore = useAppStore();

const features = ref([]);
const config = ref({
    errors: [],
    submitting: false,
})

const map = ref({
    show: false,
    latitude: '53.753443',
    longitude: '-4.024384',
    zoom: 8,
    markers: []
});

const images = ref([]);
const imagesInput = ref();
const form = ref({
    title: '',
    description: '',
    latitude: null,
    longitude: null,
    features: []
});

const editor = ref({
    show: false,
    src: '',
    activeImageIndex: null,
});


const handleImageUpload = ( files ) => {
    imagesInput.value = null;

    for (let i = 0; i < files.length; i++) {
        if ( i >= 5 ) return;

        const file = files[i];

        if (!file.type.startsWith('image/') ) continue;

        const reader = new FileReader();

        reader.onload = (e) => {
            images.value.push({
                src: e.target.result,
                aspectRatio: getAspectRatio( e.target.result )
            });
        };

        reader.readAsDataURL(file);
    }

    if( config.value.errors.images ) config.value.errors.images = null;
}

const handleSubmit = async ( e ) => {
    e.preventDefault();
    config.value.submitting = true;

    let formData = new FormData();

    // we want all images to be 1:1
    if ( images.value.length > 0 && images.value.filter(( img ) => img.aspectRatio !== 1 ).length > 0 ) {
        config.value.errors = {
            images: ['All images must have a 1:1 aspect ratio, please use the cropping tool']
        };
        config.value.submitting = false;
        return;
    }
    
    images.value.forEach(( img ) => {
        const { mimeType, extension } = getMimeTypeAndExtensionFromBase64( img.src );
        const fileName = UUID + '.' + extension;
        const file = base64ToFile( img.src, fileName, mimeType );

        formData.append(`images[]`, file, fileName);
    });

    form.value.features.forEach(( id ) => {
        formData.append(`features[]`, id);
    })
    
    Object.keys( form.value ).filter((key) => key != 'features' ).forEach(( key ) => {
        formData.append(key, form.value[key]);
    });

    await api.createPitch( formData )
        .then(( response ) => {
            appStore.pushToMessageStream({ type: 'success', title: 'upload successful', message: 'Your pitch has been uploaded successfully. You will be able to see it on Wild Pitch once we have approved the content.' });
            router.push('/my-account/pitches');
        })
        .catch(( error ) => {
            if ( !error.errors ) appStore.pushToMessageStream({ type: 'error', title: 'upload failed', message: 'Oops, theres been an error with your upload, please try again later or reach out to our team.' });
            config.value.errors = error.errors;
        });

    config.value.submitting = false;
}

const removeImage = ( index ) => {
    images.value.splice( index, 1 );
}

const editImage = ( index ) => {
    const image = images.value[index];
    editor.value = {
        src: image.src,
        show: true,
        activeImageIndex: index
    }
}

const handleCropperSave = ( e ) => {
    images.value[editor.value.activeImageIndex] = {
        src: e.image,
        aspectRatio: 1
    };
    editor.value = {
        src: null,
        show: false,
        activeImageIndex: null
    }
}

const getFeatures = async () => {
    await api.getFeatures()
        .then(( response ) => {
            features.value = response;
        })
        .catch(( error ) => {

        })
}

const toggleFeature = ( id ) => {
    if ( form.value.features.includes( id ) ) {
        form.value.features.splice( form.value.features.indexOf( id ), 1 );
        return;
    }

    form.value.features.push( id );
    config.value.errors.features = null;
}

const updatePosition = ( coords ) => {
    form.value.latitude = coords.lat.toString();
    form.value.longitude = coords.lng.toString();

    map.value.markers = [{ lat: coords.lat, lng: coords.lng }];
    config.value.errors.latitude = null;
    config.value.errors.longitude = null;
}

onMounted(() => {
    getFeatures();  
})

</script>

<template>
    <AccountLayout headerText="my pitches" subtitleText="add a new pitch, everyone will thank you!">
        <div class="flex w-full pb-16">
            <form class="inline-flex gap-5 flex-col w-full" @submit="handleSubmit">
                <div class="inline-flex gap-16 w-full flex-col lg:flex-row">
                    <div class="inline-flex flex-col w-full gap-5">
                        <div class="flex-col inline-flex gap-3">
                            <TextInput v-model:value="form.title" label="Title" :errors="config.errors?.title" @clear="config.errors.title = null"/>
                        </div>
                        <div class="flex-col inline-flex gap-3">
                            <TextAreaInput v-model:value="form.description" label="Description" :errors="config.errors?.description" @clear="config.errors.description = null" />
                        </div>
                        <div class="flex-col inline-flex gap-3">
                            <div class="text-lg">Features</div>
                            <div class="border-gray-200 border rounded-3xl p-5" :class="config.errors.features ? 'border-2 border-red-400' : ''">
                                <div v-for="( feature, i ) in features" 
                                    @click="() => toggleFeature( feature.id )" 
                                    class="inline-flex m-1 rounded-full p-2 px-4 hover:bg-gray-100 cursor-pointer gap-2 justify-center items-center border"
                                    :class="form.features.includes( feature.id ) ? 'bg-gray-200' : ''"
                                    >
                                    <font-awesome-icon :icon="'fa-solid ' + feature.icon" />
                                    <div>{{ feature.label }}</div>
                                </div>
                            </div>
                            <ErrorText v-if="config.errors.features" :text="config.errors.features[0]" />
                        </div>
                    </div>
                    <div class="inline-flex w-full flex-col gap-10">
                        <FileUpload @upload="handleImageUpload" :error="config.errors.images ? config?.errors?.images[0] : null " text="Drag and drop upto 5 images, or click " accepted-mime-types="image/jpeg, image/webp, image/png"/>
                        <div v-if="images.length > 0">
                            <VueDraggableNext v-model="images" class="grid grid-cols-3 gap-5 cursor-grab" ghost-class="ghost">
                                <div v-for="( image, i ) in images.slice(0, 5)" :class="[ i == 0 ? 'border-2 border-dashed border-black justify-between' : '' ]" class="relative rounded-xl border border-gray-500 aspect-square bg-cover bg-no-repeat bg-center inline-flex p-2 justify-end cursor-grab" :style="{ backgroundImage: `url(${image.src})`}">
                                    <font-awesome-icon v-if="i==0" icon="fa-solid fa-camera-retro" class="p-1 bg-white rounded-full aspect-square"/>
                                    <div class="inline-flex gap-1">
                                        <font-awesome-icon v-if="image.aspectRatio == 1" icon="fa-solid fa-crop" class="p-1 bg-white rounded-full aspect-square cursor-pointer" @click="() => editImage( i )"/>
                                        <font-awesome-icon icon="fa-solid fa-remove" class="p-1 bg-white rounded-full aspect-square cursor-pointer" @click="() => removeImage( i )"/>
                                    </div>
                                    <div 
                                        v-if="image.aspectRatio !== 1" 
                                        @click="() => editImage( i )" 
                                        class="bg-opacity-50 bg-white absolute top-5 bottom-5 left-5 right-5 rounded-xl inline-flex items-center justify-center cursor-pointer"
                                    >
                                        <font-awesome-icon icon="fa-solid fa-crop" size="2xl" class="aspect-square"/>
                                    </div>
                                </div>
                            </VueDraggableNext>
                        </div>
                    </div>
                </div>
                <div class="w-full aspect-video">
                    <div class="text-lg mb-2">Where is it?</div>
                    <Map class="aspect-square md:aspect-video" :latitude="form.latitude ?? map.latitude" :longitude="form.longitude ?? map.longitude" :markers="map.markers" :zoom="map.zoom" @marker-added="updatePosition" :class="config.errors.latitude || config.errors.longitude ? 'border-2 border-red-400 rounded-xl' : ''"/>
                    <ErrorText v-if="config.errors.latitude || config.errors.longitude" :text="config.errors.latitude[0] || config.errors.longitude[0]" />
                </div>
                <div class="justify-end inline-flex items-end mt-7">
                    <CustomButton text="submit" :loading="config.submitting"/>
                </div>
            </form>
        </div>
    </AccountLayout>
    <ImageEditor
        v-if="editor.show"
        :src="editor.src" 
        @close="editor.show = false"
        @save="handleCropperSave"
    />
</template>