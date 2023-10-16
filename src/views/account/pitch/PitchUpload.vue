<script setup>
import AccountLayout from '../../../components/layout/account/AccountLayout.vue';
import FileUpload from '../../../components/inputs/FileUpload.vue';
import { ref, onMounted } from 'vue';
import { VueDraggableNext } from 'vue-draggable-next'
import Api from '../../../services/Api';
import { useRouter } from 'vue-router';
import { base64ToFile, getMimeTypeAndExtensionFromBase64, UUID } from '../../../services/Helpers';
import Map from '../../../components/pitches/Map.vue';
import ErrorText from '../../../components/functional/ErrorText.vue';
import CustomButton from '../../../components/buttons/CustomButton.vue';
import TextInput from '../../../components/inputs/TextInput.vue';
import TextAreaInput from '../../../components/inputs/TextAreaInput.vue';

const api = new Api();
const router = useRouter();

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

const handleImageUpload = ( files ) => {
    imagesInput.value = null;

    for (let i = 0; i < files.length; i++) {
        if ( i >= 5 ) return;

        const file = files[i];

        if (!file.type.startsWith('image/') ) continue;

        const reader = new FileReader();

        reader.onload = (e) => {
            images.value.push(e.target.result);
        };

        reader.readAsDataURL(file);
    }

    if( config.value.errors.images ) config.value.errors.images = null;
}

const handleSubmit = async ( e ) => {
    e.preventDefault();
    config.value.submitting = true;

    let formData = new FormData();
    
    images.value.forEach(( base64 ) => {
        const { mimeType, extension } = getMimeTypeAndExtensionFromBase64( base64 );
        const fileName = UUID + '.' + extension;
        const file = base64ToFile( base64, fileName, mimeType );

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
        console.log( response );
        router.push('/my-account/pitches');
    })
    .catch(( error ) => {
        console.log( error );
        config.value.errors = error.errors;
    });

    config.value.submitting = false;
}

const removeImage = ( index ) => {
    images.value.splice( index, 1 );
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
    console.log(form.value);
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
        <div class="inline-flex w-full pb-16">
            <form class="inline-flex gap-5 flex-col" @submit="handleSubmit">
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
                        <FileUpload @upload="handleImageUpload" :error="config.errors.images ? config?.errors?.images[0] : null " text="Drag and drop upto 5 images, or click "/>
                        <div v-if="images.length > 0">
                            <VueDraggableNext v-model="images" class="grid grid-cols-3 gap-5 cursor-grab" ghost-class="ghost">
                                <div v-for="( image, i ) in images.slice(0, 5)" :class="[ i == 0 ? 'border-2 border-dashed border-black justify-between' : '' ]" class="rounded-xl border border-gray-500 aspect-square bg-cover bg-no-repeat bg-center inline-flex p-2 justify-end cursor-grab" :style="{ backgroundImage: `url(${image})`}">
                                    <font-awesome-icon v-if="i==0" icon="fa-solid fa-camera-retro" class="p-1 bg-white rounded-full aspect-square"/>
                                    <font-awesome-icon icon="fa-solid fa-remove" class="p-1 bg-white rounded-full aspect-square cursor-pointer" @click="removeImage( i )"/>
                                </div>
                            </VueDraggableNext>
                        </div>
                    </div>
                </div>
                <div class="w-full aspect-video">
                    <div class="text-lg mb-2">Where is it?</div>
                    <Map :latitude="form.latitude ?? map.latitude" :longitude="form.longitude ?? map.longitude" :markers="map.markers" :zoom="map.zoom" @marker-added="updatePosition" :class="config.errors.latitude || config.errors.longitude ? 'border-2 border-red-400 rounded-xl' : ''"/>
                    <ErrorText v-if="config.errors.latitude || config.errors.longitude" :text="config.errors.latitude[0] || config.errors.longitude[0]" />
                </div>
                <div class="justify-end inline-flex items-end mt-7">
                    <CustomButton text="submit" :loading="config.submitting"/>
                </div>
            </form>
        </div>
    </AccountLayout>
</template>