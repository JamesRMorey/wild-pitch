<script setup>
import "leaflet/dist/leaflet.css";
import { LMap, LTileLayer, LCircleMarker } from "@vue-leaflet/vue-leaflet";
import { ref, toRefs, watch } from "vue";


const emit = defineEmits([ 'markerAdded', 'markerClick', 'update:zoom' ]);

const props = defineProps({
    latitude: {
        type: String,
        required: true
    },
    longitude: {
        type: String,
        required: true
    },
    zoom: {
        type: Number,
        required: false,
        default: 15
    },
    markers: {
        type: Array,
        required: false,
        default: []
    }
});

const { zoom, latitude, longitude, markers } = toRefs( props );

const map = ref();

const addMarker = ( e ) => {
    emit( 'markerAdded', e.latlng );
}

const handleMarkerClick = ( index ) => {
    emit( 'markerClick', index );
}

const zoomVal = ref(zoom.value);

watch(zoomVal, (newVal) => {
    emit('update:zoom', newVal);
})

</script>

<template>
    <div class="w-full flex-col gap-3 inline-flex h-full">
        <div class="shadow p-2 rounded-xl h-full w-full">
            <l-map ref="map" v-model:zoom="zoomVal" :use-global-leaflet="false" :center="[latitude, longitude]" @click="addMarker">
                <l-tile-layer
                    url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    layer-type="base"
                    name="OpenStreetMap"
                ></l-tile-layer>
                <slot></slot>
                <l-circle-marker v-for="(marker, index) in markers" :lat-lng="marker" @click="(e) => handleMarkerClick( index )"></l-circle-marker>
            </l-map>
        </div>
    </div>
</template>