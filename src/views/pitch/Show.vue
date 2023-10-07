<script setup>
import { useRoute } from 'vue-router';
import Api from '../../services/Api';
import ImageGrid from '../../components/image/ImageGrid.vue';
import Reviews from '../../components/pitches/Reviews.vue';
import Map from '../../components/pitches/Map.vue';

import { ref, onMounted } from 'vue';
import PageLayout from '../../components/layout/PageLayout.vue';

const route = useRoute();
const api = new Api();
const { pitchId } = route.params;

const featuresExtended = ref(false);

const getPitch = () => {
    api.getPitch( pitchId )
        .then(( response ) => {
            updatePitch( response );
        })
        .catch(( error ) => {

        })
}

const pitch = ref(null);

const updatePitch = ( data ) => {
    pitch.value = data;
}

onMounted(() => {
    getPitch();
});

</script>

<template>
    <PageLayout>
        <div v-if="pitch">
            <div class="pt-8 inline-flex w-full justify-between items-center">
                <div class="text-3xl font-semibold truncate...">{{ pitch.title }}</div>
                <div class="inline-flex gap-2 items-center hover:bg-gray-100 py-2 cursor-pointer px-5 rounded-xl">
                    <div>save</div>
                    <font-awesome-icon icon="fa-solid fa-heart" />
                </div>
            </div>
            <div class="pt-5 pb-8">
                <ImageGrid :images="pitch.images.map((image) => image.src)" />
            </div>
            <div class="inline-flex gap-5 pb-32 w-full">
                <div class="flex-col inline-flex gap-10 w-3/5">
                    <div class="flex-col inline-flex gap-3">
                        <div class="text-xl font-semibold">A bit about this pitch</div>
                        <div>{{ pitch.description }}</div>
                    </div>
                    <div v-if="pitch.features.length > 0" class="flex-col inline-flex gap-3">
                        <div class="text-xl font-semibold">Features</div>
                            <!-- <div v-for="(feature, i) in pitch.features.slice(0, 5)" class="inline-flex gap-3 items-center">
                                <font-awesome-icon :icon="feature.icon" />
                                <div class="text-lg capitalize">{{ feature.label }}</div>
                            </div>
                            <div v-if="pitch.features.length > 5 && !featuresExtended" class="font-semibold underline cursor-pointer" @click="featuresExtended = true">
                                show more
                            </div>
                            <div v-if="featuresExtended" v-for="(feature, i) in pitch.features.slice(6, pitch.features.length)" class="inline-flex gap-3 items-center">
                                <font-awesome-icon :icon="feature.icon" />
                                <div class="text-lg capitalize">{{ feature.label }}</div>
                            </div> -->
                            <div class="border-gray-200">
                            <div v-for="( feature, i ) in pitch.features" class="inline-flex m-1 rounded-full p-2 px-4 hover:bg-gray-200 bg-gray-100 cursor-pointer gap-2 justify-center items-center">
                                <font-awesome-icon :icon="'fa-solid ' + feature.icon" />
                                <div>{{ feature.label }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-b border-gray-200 p-5 inline-flex gap-5">
                        <div class="rounded-full h-full aspect-square bg-cover bg-center" style="background-image: url('https://www.theordinaryadventurer.com/wp-content/uploads/2016/09/P5290068.jpg');"></div>
                        <div class="inline-flex flex-col">
                            <div class="text-xl font-semibold capitalize">Posted By {{ pitch.user.name }}</div>
                            <div class="text-gray-300 text-md">Member since 2023</div>
                        </div>
                    </div>
                </div>
                <div class="inline-flex flex-col gap-5 w-2/5">
                    <div class="flex-col hidden  lg:inline-flex gap-3">
                        <!-- <div class="font-semibold text-xl">Map</div> -->
                        <div class="inline-flex aspect-square flex-col">
                            <Map :latitude="pitch.latitude" :longitude="pitch.longitude" :markers="[{ lat: pitch.latitude, lng: pitch.longitude }]"/>
                        </div>
                        <div class="bg-white shadow rounded-xl px-4 py-2 inline-flex justify-between">
                            <div class="underline font-semibold cursor-pointer">Open in maps</div>
                            <div>( {{ pitch.latitude }} , {{ pitch.longitude }} )</div>
                        </div>
                    </div>
                    <!-- <div class="flex-col hidden lg:inline-flex gap-3">
                        <div class="font-semibold text-xl">Reviews</div>
                        <Reviews />
                    </div> -->
                </div>
            </div>
        </div>
    </PageLayout>
</template>
