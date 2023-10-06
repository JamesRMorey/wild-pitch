<script setup>
import { LMap, LTileLayer } from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";
import { ref } from "vue";

const map = ref();

</script>

<template>
    <div class="w-full flex-col gap-3 inline-flex">
        <div class="shadow p-5 rounded-xl">
            <l-map :center="[47.41322, -1.219482]">
            <!-- <l-tile-layer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                layer-type="base"
                name="map"
            ></l-tile-layer> -->
            </l-map>
        </div>
    </div>
</template>