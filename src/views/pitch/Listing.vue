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
import ImageWithBoxGrid from '../../components/content/ImageWithBoxGrid.vue';
import NewsLetterSignUp from '../../components/functional/NewsLetterSignUp.vue';
import TextCtaSplit from '../../components/cta/TextCtaSplit.vue';
import HeaderWithText from '../../components/content/headers/HeaderWithText.vue';
import Modal from '../../components/modals/Modal.vue';

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
    radius: radius > 0 && radius <= 100 ? radius : 15
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

const getPitches = async ( page=1 ) => {
    router.replace({ query: { locationId : selectedLocation.value.id, page: page, radius: filters.value.radius, mapMode: map.value.show } });
    await api.getPitchesForLocation( selectedLocation.value.id, page, filters.value )
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

const topLocationsBoxes = ref([
    { title: 'The Lake District', text: 'Picturesque lakes, rolling mountains, and charming valleys, attracting hikers, boaters, and nature enthusiasts,', icon: 'fa-water', link: 'pitch-listing', buttonText: 'View Pitches', image: '/images/lake_district_1.webp', locationId: 35665 },
    { title: 'Dartmoor', text: 'Known for vast open moorlands, granite tors, and ancient ruins, perfect for exploring nature\'s wild side.', icon: 'fa-binoculars', link: 'pitch-listing', buttonText: 'View Pitches', image: '/images/dartmoor_camping_1.webp', locationId: 17981 },
    { title: 'Snowdonia National Park', text: 'Majestic mountains, deep valleys, and serene lakes, offering adventure and stunning camping spots.', icon: 'fa-mountain', link: 'pitch-listing', buttonText: 'View Pitches', image: '/images/tryfan_1.webp', locationId: 57159 },
    { title: 'The Peak District', text: 'Features rolling hills, limestone valleys, and gritstone edges, ideal for hiking, climbing and camping.', icon: 'fa-cow', link: 'pitch-listing', buttonText: 'View Pitches', image: '/images/peaks_1.webp', locationId: 48740 },
]);

const handleBoxPress = ( i ) => {
    const boxPressed = topLocationsBoxes.value[i];
    handleSearch( { id: boxPressed.locationId } );
    window.scrollTo({top: 0, behavior: 'smooth'});
}

const applyFilters = () => {
    handleSearch( selectedLocation.value, 1 );
    filters.value.show = false;
}

onMounted(async () => {
    if ( locationId ) {
        await getLocation( locationId )
        handleSearch(selectedLocation.value, page ?? 1);
    }
    config.value.loaded = true;
});

</script>

<template>
    <div class="min-h-screen flex flex-col">
        <PageHeader />
        <BannerSlim title="Pitches"/>
        <Container>
            <div class="pt-8 md:pt-12 gap-12 inline-flex flex-col">
                <HeaderWithText title="Adventure Calls!" text="Type in your location, click it to search pitches around that area. When you've found one you like, head off on your adventure :)"/>
            </div>
            <div class="inline-flex w-full flex-col sm:flex-row justify-center items-center pt-16 z-10 gap-5" v-if="config.loaded">
                <LocationSearchBar class="md:w-1/2" @search="handleSearch" :initialText="selectedLocation.name ?? ''"/>
                <div class="inline-flex gap-3 w-full sm:w-auto justify-end">
                    <IconButton @press="() => filters.show = !filters.show" :active="filters.show" icon="fa-filter"/>
                    <IconButton @press="handleMapModeClick" :active="map.show" icon="fa-map"/>
                </div>
            </div>
            <div v-if="config.loaded" class="inline-flex pt-8 gap-8 z-1 flex-col lg:flex-col items-center lg:items-start">
                <Modal v-if="filters.show" confirm-text="Filter" :show-close="false" @confirm="applyFilters" @close="filters.show = false">
                    <template v-slot:content>
                        <div class="rounded-3xl bg-white w-full">
                            <div class="text-lg font">Radius</div>
                            <div class="flex flex-row justify-between w-full flex-wrap gap-3 mt-2">
                                <div v-for="( distance, i ) in ['5', '15', '30', '50', '100']" class="flex gap-5 flex-col justify-center items-center">
                                    <div 
                                        class="p-3.5 rounded-full cursor-pointer transition-all ease-in-out"
                                        :class="filters.radius == distance ? 'bg-green' : 'bg-gray-100'"
                                        @click="() => filters.radius = distance"
                                    ></div>
                                    <div>{{ distance }}km</div>
                                </div>
                            </div>
                        </div>
                    </template>
                </Modal>
                <div class="inline-flex w-full flex-col">
                    <div v-if="!map.show" class="relative w-full inline-flex items-center justify-center mb-0">
                        <div v-if="loading" class="w-full h-full rounded-2xl z-2 absolute justify-center items-center inline-flex p-32 bg-white opacity-50">
                            <PulseLoader color="#000000" />
                        </div>
                        <div v-if="pitches.length > 0" class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 pb-8">
                            <PitchCard v-for="(pitch, i) in pitches" :title="pitch.title" :description="pitch.description" :img="pitch?.images[0]?.src" :pitchId="pitch.id" :is-saved="pitch.is_saved" :features="pitch.features"/>
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
            <hr />
            <div class="flex-col flex gap-12 py-8 md:py-12">
                <div class="gap-12 inline-flex flex-col">
                    <HeaderWithText title="Need Some Ideas?" text="These places are super popular with our users, and for good reason! These places have some of the best wild camping spots the UK has to offer "/>
                    <ImageWithBoxGrid :boxes="topLocationsBoxes" image="/backgrounds/square/square_2.webp" @boxPress="handleBoxPress"/>
                </div>
                <div class="inline-flex flex-col">
                    <NewsLetterSignUp />
                </div>
            </div>
        </Container>
        <div class="flex flex-1"></div>
        <PageFooter />
    </div>
</template>
