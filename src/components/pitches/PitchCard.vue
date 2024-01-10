<script setup>
import { ref, toRefs } from 'vue';
import Api from '../../services/Api';
import { useAuthStore } from '../../stores/auth';

const api = new Api();
const authStore = useAuthStore();

const props = defineProps({
    title: {
        type: String,
        required: false,
        default: 'A pitch'
    },
    description: {
        type: String,
        required: false,
        default: 'An awesome pitch with sea views and views of snowdon, its quite special'
    },
    features: {
        type: Array,
        required: false,
        default: []
    },
    img: {
        type: String,
        required: true,
        default: ''
    },
    pitchId: {
        type: Number,
        required: true,
    },
    isSaved: {
        type: Boolean,
        required: false,
        default: false
    },
    features: {
        type: Array,
        required: false,
        default: []
    }
});

const { isSaved } = toRefs( props );

const saved = ref(isSaved.value);

const savePitch = async ( id ) => {
    await api.savePitch( id )
    .then(( response ) => {
        saved.value = true;
    })
    .catch(( error ) => {
        console.log( error );
    })
}

const unSavePitch = async ( id ) => {
    await api.unSavePitch( id )
    .then(( response ) => {
        saved.value = false;
    })
    .catch(( error ) => {
        console.log( error );
    })
}

</script>

<template>
    <div class="w-full inline-flex flex-col gap-3 justify-center bg-center bg-cover group">
        <div class="w-full rounded-xl bg-center bg-cover aspect-square text-right relative">
            <router-link :to="{ name: 'pitch-show', params: { pitchId: pitchId } }">
                <img :src="img" class="object-cover object-center flex w-full rounded-xl aspect-square hover:brightness-75 transition-all ease-in-out" />
            </router-link>
            <div v-if="authStore.user" class="absolute top-3 right-3 bg-white hover: bg-gray-100 rounded-full aspect-square w-9 flex items-center justify-center hover:text-red-600"
                :class="saved ? 'text-red-600 hover:text-gray-800' : ''"
            >
                <font-awesome-icon v-if="saved" icon="fa-solid fa-heart" class="cursor-pointer" size="lg" @click="() => unSavePitch( pitchId )"/>
                <font-awesome-icon v-else icon="fa-solid fa-heart-broken" class="cursor-pointer" size="lg" @click="() => savePitch( pitchId )"/>
            </div>
        </div>
        
        <div class="flex flex-col justify-between items-between gap-5">
            <div class="inline-flex flex-col">
                <div class="text-lg font-semibold capitalize truncate ...">{{ title }}</div>
                <div class="text-grey truncate ...">{{ description }}</div>
            </div>
            <div class="flex justify-between items-end">
                <div v-if="features.length" class="flex gap-1 items-end px-2 truncate ... p-2 bg-gray-800 rounded-xl">
                    <div v-for="( feature, i ) in features.slice(0,5)">
                        <font-awesome-icon :icon="feature.icon" class="text-white"/>
                    </div>
                </div>
                <div v-else></div>
                <router-link :to="{ name: 'pitch-show', params: { pitchId: pitchId } }"  class="flex h-full items-center bg-green text-white px-5 py-1 rounded-xl hover:bg-green-dark transition-all ease-in-out text-right font-semibold">
                    view
                </router-link>
            </div>
        </div>
    </div>
</template>