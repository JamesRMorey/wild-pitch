<script setup>
import AccountLayout from '../../../components/layout/account/AccountLayout.vue';
import AccountPitchCard from '../../../components/account/AccountPitchCard.vue';
import Api from '../../../services/Api';
import { ref, onMounted, computed } from 'vue';
import { useRouter } from 'vue-router';
import Map from '../../../components/pitches/Map.vue';
import { LControl } from '@vue-leaflet/vue-leaflet';
import Modal from '../../../components/modals/Modal.vue';
import IconButton from '../../../components/buttons/IconButton.vue';
import NoResults from '../../../components/functional/NoResults.vue';
import Alert from '../../../components/functional/Alert.vue';
import PitchCardLoader from '../../../components/loaders/PitchCardLoader.vue';

const api = new Api();
const router = useRouter();

const pitches = ref([]);

const config = ref({
    loading: true
})
const selectedLocation = ref({});
const map = ref({
    show: false,
    latitude: selectedLocation.value.latitude ?? '53.753443',
    longitude: selectedLocation.value.longitude ?? '-4.024384',
    zoom: 5,
    markers: []
});
const mapActivePitch = ref({
    show: false
});
const modal = ref({
    show: false,
    pitch: null
})

const getPitches = async () => {
    await api.getUserPitches()
        .then(( response ) => {
            updatePitches( response );
            config.value.loading = false;
        })
        .catch(( error ) => {
            console.log( error );
            config.value.loading = false;
        })
}

const updatePitches = ( data ) => {
    pitches.value = data;
    map.value.markers = data.map(( pitch ) => {
        return { lat: pitch.latitude, lng: pitch.longitude }
    });
    mapActivePitch.value.show = false;
}

const deletePitch = async ( id ) => {
    await api.deletePitch( id )
        .then(( response ) => {
            const index = pitches.value.findIndex(( pitch ) => pitch.id == id );
            pitches.value.splice(index, 1);
            map.value.markers.splice(index, 1);
            if ( mapActivePitch.value.id == id ) mapActivePitch.value = { show: false };
            modal.value.show = false;
            modal.value.pitch = null;
        })
        .catch(( error ) => {
            modal.value.show = false;
            modal.value.pitch = null;  
        })
}

const handleDestroy = ( id ) => {
    modal.value.show = true;
    modal.value.pitch = pitches.value.find(( pitch ) => pitch.id == id );
}

const closeConfirmModal = () => {
    modal.value.show = false;
    modal.value.pitch = null;
}

const handleAddButtonClick = () => {
    router.push('/my-account/pitches/create');
}

const handleMapButtonClick = () => {
    map.value.show = !map.value.show
}

const markerClicked = ( index ) => {
    const mkr = map.value.markers[index];
    mapActivePitch.value = pitches.value.find(( pitch ) => {
        return pitch.latitude == mkr.lat && pitch.longitude == mkr.lng
    });
    map.value.latitude = mapActivePitch.value.latitude;
    map.value.longitude = mapActivePitch.value.longitude;
    mapActivePitch.value.show = true;
}

const pageButtons = ref([
    { text: 'Add', click: handleAddButtonClick },
])

const handleMapControlClick = () => {
    router.push('/pitches/pitch/' + mapActivePitch.value.id );
}


onMounted(() => {
    getPitches();
})

const isLoaded = computed(() => {
    return pitches.value.length > 0;
})

</script>

<template>
    <AccountLayout headerText="my pitches" subtitleText="manage, add and remove your listings" :buttons="pageButtons">
        <div class="inline-flex justify-start pb-4">
            <IconButton class="block" icon="fa-map" @press="handleMapButtonClick" :active="map.show" />
        </div>
        <div v-if="map.show" class="inline-flex">
            <div class="w-full aspect-[4/6] md:aspect-video mb-6">
                <Map :latitude="map.latitude" :longitude="map.longitude" :markers="map.markers" v-model:zoom="map.zoom" @markerClick="markerClicked">
                    <l-control
                        v-if="mapActivePitch.show"
                        :position="'topright'"
                        class="bg-white border-gray-200 border hover:bg-gray-100 shadow p-5 m-3 max-w-60 rounded-xl inline-flex text-right justify-center gap-4"
                        @click="handleMapControlClick"
                    >
                    <div class="flex-col gap-6 inline-flex text-right items-center cursor-pointer">
                        <div class="aspect-square border-2 border-gray-500 bg-cover bg-no-repeat bg-center h-20 w-20 rounded-full" :style="{ backgroundImage: `url(${mapActivePitch.images[0].src})`}"></div>
                        <div class="gap-2 inline-flex flex-col">
                            <div class="font-semibold text-md truncate ...">{{ mapActivePitch.title }}</div>
                        </div>
                    </div>
                    </l-control>
                </Map>
            </div>
        </div>
        <div v-else class="inline-flex flex-col gap-10">
            <Alert class="mt-2" text="Only approved pitches are displayed here, typically within 24 hours. We appreciate your patience as our team ensures quality content. If you have any questions, feel free to reach out." />
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5 md:px-8 mb-16">
                <AccountPitchCard 
                    v-if="isLoaded" 
                    v-for="( pitch, i ) in pitches" 
                    @destroy="handleDestroy" 
                    :id="pitch.id" 
                    :description="pitch.description" 
                    :title="pitch.title" 
                    :img="pitch?.images[0]?.src" 
                    :features="pitch.features"
                />
                <PitchCardLoader 
                    v-if="!isLoaded"
                    v-for="i in 10"
                />
            </div>
            <!-- <div v-else class="inline-flex justify-center items-center w-full">
                <NoResults :text="'You dont have any pitches, why not add one now?'" />
            </div> -->
        </div>
        <Modal v-if="modal.show" @close="closeConfirmModal" @confirm="deletePitch( modal.pitch.id )" confirmText="Yep, delete it">
            <template v-slot:title>
                <div class="text-lg font-semibold">Woah! Hold on a sec</div>
            </template>
            <template v-slot:content>
                <div class="w-full">
                    Are you sure you want to delete <span class="font-semibold">{{ modal.pitch.title }}?</span>
                </div>
            </template>
        </Modal>
    </AccountLayout>
</template>