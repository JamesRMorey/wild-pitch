<script setup>
import { useRoute } from 'vue-router';
import Api from '../../services/Api';
import ImageGrid from '../../components/image/ImageGrid.vue';
import Map from '../../components/pitches/Map.vue';
import { useAuthStore } from '../../stores/auth';

import { ref, onMounted, watch } from 'vue';
import PageLayout from '../../components/layout/PageLayout.vue';
import TextCtaSplit from '../../components/cta/TextCtaSplit.vue';
import BackBar from '../../components/layout/BackBar.vue';
import PitchSlider from '../../components/sliders/PitchSlider.vue';
import HeaderWithText from '../../components/content/headers/HeaderWithText.vue';

const route = useRoute();
const api = new Api();
const { pitchId } = route.params;
const authStore = useAuthStore();

const getPitch = async () => {
    await api.getPitch( pitchId )
        .then(( response ) => {
            updatePitch( response );
        })
        .catch(( error ) => {

        })
}

const getOthersInArea = async () => {
    api.getPitchesInArea( pitchId )
        .then(( response ) => {
            pitchesInArea.value = response;
        })
        .catch(( error ) => {

        })
}

const pitch = ref(null);
const pitchesInArea = ref([]);

const updatePitch = ( data ) => {
    pitch.value = data;
}

const savePitch = async ( id ) => {
    await api.savePitch( id )
    .then(( response ) => {
        pitch.value.is_saved = true;
    })
    .catch(( error ) => {
        console.log( error );
    })
}

const unSavePitch = async ( id ) => {
    await api.unSavePitch( id )
    .then(( response ) => {
        pitch.value.is_saved = false;
    })
    .catch(( error ) => {
        console.log( error );
    })
}

onMounted(() => {
    getPitch();
    getOthersInArea();
});

</script>

<template>
    <PageLayout>
        <div v-if="pitch" class="pt-2 ">
            <BackBar class="mb-2"/>
            <div class="inline-flex w-full justify-between items-center">
                <div class="text-3xl font-semibold truncate...">{{ pitch.title }}</div>
                <div v-if="authStore.user">
                    <div v-if="!pitch.is_saved" class="inline-flex gap-2 items-center hover:bg-gray-100 py-2 cursor-pointer px-5 rounded-xl transition-all ease-in-out" @click="() => savePitch( pitchId )">
                        <div class="font-semibold text-lg">save</div>
                        <font-awesome-icon icon="fa-solid fa-heart-broken" class="group-hover:text-gray-800"/>
                    </div>
                    <div v-else class="inline-flex gap-2 items-center hover:bg-gray-100 py-2 cursor-pointer px-5 rounded-xl group transition-all ease-in-out" @click="() => unSavePitch( pitchId )">
                        <div class="font-semibold text-lg">saved</div>
                        <font-awesome-icon icon="fa-solid fa-heart" class="text-red-600 group-hover:text-gray-800" />
                    </div>
                </div>
            </div>
            <div class="pt-5 pb-8">
                <ImageGrid :images="pitch.images.map((image) => image.src)" />
            </div>
            <div class="inline-flex gap-5 w-full flex-col lg:flex-row">
                <div class="flex-col inline-flex gap-10 w-full lg:w-3/5">
                    <div class="flex-col inline-flex gap-3">
                        <div class="text-xl font-semibold">What To Expect</div>
                        <div v-html="pitch.description" class="whitespace-pre-line bg-gray-100 p-5 rounded-xl"></div>
                    </div>
                    <div v-if="pitch.features.length > 0" class="flex-col inline-flex gap-3">
                        <div class="text-xl font-semibold">Features</div>
                            <div class="border-gray-200">
                            <div v-for="( feature, i ) in pitch.features" class="inline-flex m-1 transition-all ease-in-out rounded-full p-2 px-4 hover:bg-gray-200 bg-gray-100 cursor-pointer gap-2 justify-center items-center">
                                <font-awesome-icon :icon="'fa-solid ' + feature.icon" />
                                <div>{{ feature.label }}</div>
                            </div>
                        </div>
                    </div>
                    <div v-if="pitch.user" class="bg-gray-800 rounded-2xl px-6 py-10 hidden lg:inline-flex gap-5 text-white">
                        <div class="aspect-square rounded-full bg-white p-1 h-20">
                            <div class="rounded-full h-full aspect-square bg-cover bg-center" style="background-image: url('/logos/icon.webp')"></div>
                        </div>
                        <div class="inline-flex flex-col">
                            <div class="text-xl font-semibold capitalize">Posted By <router-link :to="{ name: 'home' }" class="link">{{ pitch.user.name }}</router-link></div>
                            <div class="text-gray-300 text-md">Member since 2023</div>
                            <div class="text-gray-300 text-sm">Check out other pitches by this user <router-link :to="{ name: 'home' }" class="link">here</router-link></div>
                        </div>
                    </div>
                </div>
                <div class="inline-flex flex-col gap-5 w-full lg:w-2/5">
                    <div class="flex-col inline-flex gap-3">
                        <!-- <div class="font-semibold text-xl">Map</div> -->
                        <div class="inline-flex aspect-square flex-col">
                            <Map :latitude="pitch.latitude" :longitude="pitch.longitude" :markers="[{ lat: pitch.latitude, lng: pitch.longitude }]"/>
                        </div>
                        <div class="py-2 inline-flex justify-between items-center">
                            <a class="bg-gray-100 hover:bg-gray-200 transition-all ease-in-out cursor-pointer px-5 py-2 rounded-2xl gap-3 inline-flex justify-between items-center" :href="'https://www.google.com/maps?q=' + pitch.latitude + ',' + pitch.longitude" target="_blank">
                                Google Maps 
                                <font-awesome-icon icon="fa-solid fa-up-right-from-square"></font-awesome-icon>
                            </a>
                            <div>( {{ pitch.latitude }} , {{ pitch.longitude }} )</div>
                        </div>
                    </div>
                </div>
                <div v-if="pitch.user" class="bg-gray-800 rounded-2xl px-6 py-10 lg:hidden inline-flex gap-5 text-white">
                    <div class="aspect-square rounded-full bg-white p-1 h-20">
                        <div class="rounded-full h-full aspect-square bg-cover bg-center" style="background-image: url('/logos/icon.webp')"></div>
                    </div>
                    <div class="inline-flex flex-col">
                        <div class="text-xl font-semibold capitalize">Posted By <router-link :to="{ name: 'home' }" class="link">{{ pitch.user.name }}</router-link></div>
                        <div class="text-gray-300 text-md">Member since 2023</div>
                        <div class="text-gray-300 text-sm">Check out other pitches by this user <router-link :to="{ name: 'home' }" class="link">here</router-link></div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="pitchesInArea.length > 0" class="py-8 md:py-12 inline-flex flex-col w-full gap-8">
            <hr/>
            <HeaderWithText title="In The Area" text="Other pitches around this one" />
            <PitchSlider :pitches="pitchesInArea" />
        </div>
        <div class="py-8 md:py-12 inline-flex flex-col w-full">
            <TextCtaSplit :cta-1="{ text: 'find out more', link: { name: 'register' } }" :cta-2="{ text: 'sign up now', link: { name: 'register' } }" title="Join The Wild Pitch Community!" text="Find your next adventure from one of our amazing members" />
        </div>
    </PageLayout>
</template>
