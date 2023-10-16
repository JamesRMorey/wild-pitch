<script setup>
import { ref, onMounted, watch } from 'vue';
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
import { LControl, LCircle } from '@vue-leaflet/vue-leaflet';
import IconButton from '../../components/buttons/IconButton.vue';

const api = new Api();

const route = useRoute();
const router = useRouter();
const { locationId, page, radius, mapMode } = route.query;

const config = ref({
    loaded: false
});
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
const filters = ref({
    show: false,
    radius: radius > 0 && radius <= 100 ? radius : 5
})
const map = ref({
    show: mapMode == 1 ? 1 : 0,
    latitude: selectedLocation.value.latitude ?? '53.753443',
    longitude: selectedLocation.value.longitude ?? '-4.024384',
    zoom: 5,
    markers: []
});
const mapActivePitch = ref({
    show: false
});
const showInitialNoResults = ref(true);

const handleSearch = ( location, page=1 ) => {
    loading.value = true;
    showInitialNoResults.value = false;
    selectedLocation.value = location;
    paginator.value.page = page;
    map.value.latitude = location.latitude;
    map.value.longitude = location.longitude;
    getPitches( page );
}

const getLocation = async ( id ) => {
    await api.getLocation( id )
    .then(( response ) => {
        selectedLocation.value = response;
    })
    .catch(() => {

    })
}

const getPitches = ( page=1 ) => {
    router.replace({ query: { locationId : selectedLocation.value.id, page: page, radius: filters.value.radius, mapMode: map.value.show } });
    api.getPitchesForLocation( selectedLocation.value.id, page, filters.value )
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

const handleMapModeClick = () => {
    map.value.show = map.value.show == 1 ? 0 : 1
    const newQuery = { ...route.query };
    newQuery.mapMode = map.value.show;
    router.replace({ query: newQuery });
}

onMounted(async () => {
    if ( locationId ) {
        await getLocation( locationId )
        handleSearch(selectedLocation.value, page ?? 1);
    }
    config.value.loaded = true;
})

</script>

<template>
    <div class="min-h-screen flex flex-col">
        <PageHeader />
        <BannerSlim title="Pitches"/>
        <Container>
            <div class="inline-flex w-full flex-col sm:flex-row justify-center items-center pt-16 z-10 gap-5" style="z-index: 10000;" v-if="config.loaded">
                <LocationSearchBar class="md:w-1/2" @search="handleSearch" :initialText="selectedLocation.name ?? ''"/>
                <div class="inline-flex gap-3">
                    <IconButton @press="() => filters.show = !filters.show" :active="filters.show" icon="fa-filter"/>
                    <IconButton @press="handleMapModeClick" :active="map.show" icon="fa-map"/>
                </div>
            </div>
            <div v-if="config.loaded" class="inline-flex pt-8 gap-8 z-1 flex-col lg:flex-row items-center lg:items-start">
                <div v-if="filters.show" class="w-64 flex-col inline-flex">
                    <div class="w-full inline-flex flex-col shadow p-5 rounded-xl">
                        <div class="text-lg font-semibold">Search Radius</div>
                        <select
                            id="select"
                            v-model="filters.radius"
                            class="w-full mt-2 border bg-gray-100 rounded-md px-2 py-2"
                            @change="handleSearch( selectedLocation, 1 )"
                            >
                            <option value="5">5km</option>
                            <option value="15">15km</option>
                            <option value="30">30km</option>
                            <option value="50">50km</option>
                            <option value="100">100km</option>
                        </select>
                    </div>
                </div>
                <div class="inline-flex w-full flex-col">
                    <div v-if="!map.show" class="relative w-full inline-flex items-center justify-center mb-0">
                        <div v-if="loading" class="w-full h-full rounded-2xl z-2 absolute justify-center items-center inline-flex p-32 bg-white opacity-50">
                            <PulseLoader />
                        </div>
                        <div v-if="pitches.length > 0" class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 pb-8">
                            <div v-for="(pitch, i) in pitches">
                                <PitchCard :title="pitch.title" :description="pitch.description" :img="pitch?.images[0]?.src" :pitchId="pitch.id" :is-saved="pitch.is_saved" :features="pitch.features"/>
                            </div>
                        </div>
                        <div v-else-if="showInitialNoResults" class="inline-flex justify-center items-center pb-8">
                            <NoResults text="So... where are we going?"/>
                        </div>
                        <div v-else class="inline-flex justify-center items-center pb-8">
                            <NoResults />
                        </div>
                    </div>
                    <div v-if="map.show" class="w-full aspect-[4/6] md:aspect-video mb-6">
                        <Map :latitude="map.latitude" v-model:zoom="map.zoom" :longitude="map.longitude" :markers="map.markers" @markerClick="markerClicked">
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
                            <l-circle v-if="selectedLocation.latitude" :lat-lng="[ selectedLocation.latitude, selectedLocation.longitude ]" :radius="parseInt(filters.radius ?? 5)*1.5*1000" color="#609966" />
                        </Map>
                    </div>
                    <div v-if="pitches.length > 0" class="inline-flex justify-between items-end pb-10">
                        <div class="text-lg">{{ paginator.from }} to {{ paginator.to }} of ... {{ paginator.total }}</div>
                        <div class="inline-flex gap-3">
                            <font-awesome-icon v-if="paginator.page > 1" icon="fa-solid fa-chevron-left" size="xl" class="p-3 aspect-square rounded-full bg-gray-100 hover:bg-gray-200 cursor-pointer" @click="pageDown()"/>
                            <font-awesome-icon v-else icon="fa-solid fa-chevron-left" size="xl" class="p-3 text-transparent aspect-square rounded-full"/>
                            <font-awesome-icon v-if="paginator.page < paginator.lastPage" icon="fa-solid fa-chevron-right" size="xl" class="p-3 aspect-square rounded-full bg-gray-100 hover:bg-gray-200 cursor-pointer" @click="pageUp()"/>
                            <font-awesome-icon v-else icon="fa-solid fa-chevron-right" size="xl" class="p-3 text-transparent aspect-square rounded-full"/>
                        </div>
                    </div>
                </div>
            </div>
        </Container>
        <div class="flex flex-1"></div>
        <PageFooter />
    </div>
</template>
