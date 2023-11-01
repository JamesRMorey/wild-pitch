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
    <div class="w-full inline-flex flex-col gap-3 justify-center bg-center bg-cover">
        <router-link :to="'/pitches/pitch/' + pitchId" class="w-full rounded-xl bg-center bg-cover aspect-square text-right p-4" :style="{ backgroundImage: `url(${img})`}">
            <div v-if="authStore.user">
                <font-awesome-icon v-if="saved" icon="fa-solid fa-heart" class="cursor-pointer" size="lg" @click="() => unSavePitch( pitchId )"/>
                <font-awesome-icon v-else icon="fa-solid fa-heart-broken" class="cursor-pointer" size="lg" @click="() => savePitch( pitchId )"/>
            </div>
        </router-link>
        <div class="inline-flex flex-col">
            <div class="inline-flex flex-col">
                <div class="text-lg font-semibold capitalize truncate ...">{{ title }}</div>
                <div class="text-grey truncate ...">{{ description }}</div>
            </div>
            <div class="inline-flex justify-between">
                <div v-if="features.length" class="inline-flex gap-1 items-end px-2 truncate ...">
                    <div v-for="( feature, i ) in features.slice(0,6)">
                        <font-awesome-icon :icon="feature.icon" />
                    </div>
                </div>
                <div v-else></div>
                <router-link :to="'/pitches/pitch/' + pitchId"  class="mt-5 bg-gray-100 px-3 py-1 rounded-xl hover:bg-gray-200 text-right">
                    view
                </router-link>
            </div>
        </div>
    </div>
</template>