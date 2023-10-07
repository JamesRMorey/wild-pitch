<script setup>
import { ref, onMounted } from 'vue';
import Api from '../../services/Api';
import { useRoute, useRouter } from 'vue-router';

import PageHeader from '../../components/layout/PageHeader.vue';
import PageFooter from '../../components/layout/PageFooter.vue';
import BannerSlim from '../../components/banners/BannerSlim.vue';
import PitchCard from '../../components/pitches/PitchCard.vue';
import Container from '../../components/layout/Container.vue';
import LocationSearchBar from '../../components/functional/LocationSearchBar.vue';
import NoResults from '../../components/functional/NoResults.vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import Map from '../../components/pitches/Map.vue';
import CustomButton from '../../components/buttons/CustomButton.vue';
import { LControl } from '@vue-leaflet/vue-leaflet';

const api = new Api();

const route = useRoute();
const router = useRouter();
const { locationId, locationName, page } = route.query;

const pitches = ref([]);
const loading = ref(false);
const paginator = ref({
    page: page ?? 1,
    from: 0,
    to: 0,
    total: 0,
    perPage: 0,
    lastPage: 0
});
const selectedLocation = ref({});

const showInitialNoResults = ref(true);

const handleSearch = ( location, page=1 ) => {
    loading.value = true;
    showInitialNoResults.value = false;
    selectedLocation.value = location;
    paginator.value.page = page;
    getPitches( page );
}

const getPitches = ( page=1 ) => {
    router.replace({ query: { locationId : selectedLocation.value.id, locationName: selectedLocation.value.name, page: page } });
    api.getPitchesForLocation( selectedLocation.value.id, page )
        .then(( response ) => {
            loading.value = false;
            const { data } = response;
            updatePitches( data );
            updatePaginator( response );
        })
        .catch(( error ) => {
            loading.value = false
        });
}

const updatePitches = ( data ) => {
    pitches.value = data;
    map.value.markers = data.map(( pitch ) => {
        return { lat: pitch.latitude, lng: pitch.longitude }
    });
    mapActivePitch.value.show = false;
}

const updatePaginator = ( response ) => {
    paginator.value = {
        page: response.current_page,
        from: response.from,
        to: response.to,
        total: response.total,
        perPage: response.per_page,
        lastPage: response.last_page
    }
}

const pageDown = () => {
    getPitches( paginator.value.page - 1 );
}

const pageUp = () => {
    getPitches( paginator.value.page + 1 );
}

const map = ref({
    show: false,
    latitude: '53.753443',
    longitude: '-4.024384',
    zoom: 5,
    markers: []
});

const mapActivePitch = ref({
    show: false
});

const markerClicked = ( index ) => {
    const mkr = map.value.markers[index];
    mapActivePitch.value = pitches.value.find(( pitch ) => {
        return pitch.latitude == mkr.lat && pitch.longitude == mkr.lng
    });
    map.value.latitude = mapActivePitch.value.latitude;
    map.value.longitude = mapActivePitch.value.longitude;
    mapActivePitch.value.show = true;
}

const handleMapControlClick = () => {
    router.push('/pitches/pitch/' + mapActivePitch.value.id );
}

onMounted(() => {
    if ( locationId && locationName ) {
        handleSearch({
            id: locationId,
            name: locationName
        }, page ?? 1);
    }
})

</script>

<template>
    <PageHeader />
    <BannerSlim title="Pitches"/>
    <Container>
        <div class="inline-flex w-full justify-center items-center pt-16 z-10 gap-5">
            <LocationSearchBar @search="handleSearch" :initialText="locationName"/>
            <CustomButton :press-handler="() => map.show = !map.show" :text="map.show ? 'list view' : 'map view'" />
        </div>
        <div v-if="!map.show" class="relative inline-flex items-center justify-center mb-0 px-8">
            <div v-if="loading" class="w-full h-full rounded-2xl z-2 absolute justify-center items-center inline-flex p-32 bg-white opacity-50">
                <PulseLoader />
            </div>
            <div v-if="pitches.length > 0" class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 py-8">
                <div v-for="(pitch, i) in pitches">
                    <PitchCard :title="pitch.title" :description="pitch.description" :img="pitch?.images[0]?.src" :pitchId="pitch.id"/>
                </div>
            </div>
            <div v-else-if="showInitialNoResults" class="inline-flex justify-center items-center pb-8">
                <NoResults text="So... where are we going?"/>
            </div>
            <div v-else class="inline-flex justify-center items-center pb-8">
                <NoResults />
            </div>
        </div>
        <div v-if="map.show" class="w-full aspect-video mb-6 mt-8">
            <Map :latitude="map.latitude" :longitude="map.longitude" :markers="map.markers" :zoom="map.zoom" @markerClick="markerClicked">
                <l-control
                    v-if="mapActivePitch.show"
                    :position="'topright'"
                    class="bg-white border-gray-200 border hover:bg-gray-100 shadow p-5 m-3 w-60 rounded-3xl inline-flex text-right gap-4"
                    @click="handleMapControlClick"
                >
                <div class="inline-flex justify-between w-full cursor-pointer">
                    <div class="aspect-square border-2 border-gray-500 bg-cover bg-no-repeat bg-center h-16 rounded-full" :style="{ backgroundImage: `url(${mapActivePitch.images[0].src})`}"></div>
                    <div class="inline-flex flex-col gap-2 w-full items-end justify-between">
                        <div>
                            <div class="font-semibold text-md truncate ...">{{ mapActivePitch.title }}</div>
                            <div class="text-md truncate ...">a lovely pitch</div>
                        </div>
                        <div class="font-semibold underline">click to view</div>
                    </div>
                </div>
                </l-control>
            </Map>
        </div>
        <div v-if="pitches.length > 0" class="inline-flex justify-between items-end px-8 pb-10">
            <div class="text-lg">{{ paginator.from }} to {{ paginator.to }} of ... {{ paginator.total }}</div>
            <div class="inline-flex gap-3">
                <font-awesome-icon v-if="paginator.page > 1" icon="fa-solid fa-chevron-left" size="xl" class="p-3 aspect-square rounded-full bg-gray-100 hover:bg-gray-200 cursor-pointer" @click="pageDown()"/>
                <font-awesome-icon v-else icon="fa-solid fa-chevron-left" size="xl" class="p-3 text-transparent aspect-square rounded-full"/>
                <font-awesome-icon v-if="paginator.page < paginator.lastPage" icon="fa-solid fa-chevron-right" size="xl" class="p-3 aspect-square rounded-full bg-gray-100 hover:bg-gray-200 cursor-pointer" @click="pageUp()"/>
                <font-awesome-icon v-else icon="fa-solid fa-chevron-right" size="xl" class="p-3 text-transparent aspect-square rounded-full"/>
            </div>
        </div>
    </Container>
    <PageFooter />
</template>
