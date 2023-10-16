<script setup>
import AccountLayout from '../../../components/layout/account/AccountLayout.vue';
import AccountPitchCard from '../../../components/account/AccountPitchCard.vue';
import Api from '../../../services/Api';
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import Map from '../../../components/pitches/Map.vue';
import { LControl } from '@vue-leaflet/vue-leaflet';
import Modal from '../../../components/modals/Modal.vue';
import IconButton from '../../../components/buttons/IconButton.vue';
import NoResults from '../../../components/functional/NoResults.vue';

const api = new Api();
const router = useRouter();

const pitches = ref([]);

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
        })
        .catch(( error ) => {
            console.log( error );
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
    { text: 'add', click: handleAddButtonClick },
])

onMounted(() => {
    getPitches();
})

</script>

<template>
    <AccountLayout headerText="my pitches" subtitleText="manage, add and remove your listings" :buttons="pageButtons">
        <div class="inline-flex justify-start pb-4">
            <IconButton v-if="pitches.length" class="block" icon="fa-map" @press="handleMapButtonClick" :active="map.show" />
        </div>
        <div v-if="map.show" class="inline-flex">
            <div class="w-full aspect-[4/6] md:aspect-video mb-6">
                <Map :latitude="map.latitude" :longitude="map.longitude" :markers="map.markers" v-model:zoom="map.zoom" @markerClick="markerClicked">
                    <l-control
                        v-if="mapActivePitch.show"
                        :position="'topright'"
                        class="bg-white border-gray-200 border hover:bg-gray-100 shadow p-5 m-3 w-60 rounded-3xl inline-flex text-right gap-4"
                    >
                        <div class="aspect-square border-2 border-gray-500 bg-cover bg-no-repeat bg-center h-16 rounded-full" :style="{ backgroundImage: `url(${mapActivePitch.images[0].src})`}"></div>
                        <div class="inline-flex flex-col gap-2 w-full items-end justify-between">
                            <div>
                                <div class="font-semibold text-md truncate ...">{{ mapActivePitch.title }}</div>
                                <div class="text-md truncate ...">a lovely pitch</div>
                            </div>
                            <div class="inline-flex gap-2">
                                <router-link :to="'/pitches/pitch/' + mapActivePitch.id"  class="">
                                    <font-awesome-icon icon="fa-solid fa-eye" class="cursor-pointer" />
                                </router-link>
                                <div>
                                    <font-awesome-icon icon="fa-solid fa-remove" class="cursor-pointer" @click="() => deletePitch( mapActivePitch.id )"/>
                                </div>
                            </div>
                        </div>
                    </l-control>
                </Map>
            </div>
        </div>
        <div v-else>
            <div v-if="pitches.length" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5 md:px-8 mb-16">
                <AccountPitchCard v-if="pitches.length" v-for="( pitch, i ) in pitches" @destroy="handleDestroy" :id="pitch.id" :description="pitch.description" :title="pitch.title" :img="pitch?.images[0]?.src" :features="pitch.features"/>
            </div>
            <div v-else class="inline-flex justify-center items-center w-full">
                <NoResults :text="'You dont have any pitches, why not add one now?'" />
            </div>
        </div>
        <Modal v-if="modal.show" @close="closeConfirmModal" @confirm="deletePitch( modal.pitch.id )" confirmText="yep, delete it">
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