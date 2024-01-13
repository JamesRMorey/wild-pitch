<script setup>
import { toRefs } from 'vue';
import Api from '../../services/Api';

const emit = defineEmits([ 'edit', 'destroy' ]);

const api = new Api();

const props = defineProps({
    id: {
        type: Number,
        required: true,
    },
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
    }
});

const { id } = toRefs( props );

const destroy = async () => {
    emit( 'destroy', id.value );
}
</script>

<template>
    <div class="w-full inline-flex flex-col gap-3 justify-center bg-center bg-cover group">
        <div class="w-full rounded-xl bg-center bg-cover aspect-square text-right relative">
            <router-link :to="{ name: 'pitch-show', params: { pitchId: id } }">
                <img :src="img" class="object-cover object-center flex w-full rounded-xl aspect-square hover:brightness-75 transition-all ease-in-out" />
            </router-link>
        </div>
        
        <div class="flex flex-col justify-between items-between gap-5">
            <div class="inline-flex flex-col">
                <div class="text-lg font-semibold capitalize truncate ...">{{ title }}</div>
                <div class="text-grey truncate ...">{{ description }}</div>
            </div>
            <div class="flex justify-between items-end">
                <div v-if="features.length" class="flex gap-2 items-end px-2 truncate ... p-2 bg-gray-800 rounded-xl">
                    <div v-for="( feature, i ) in features.slice(0,4)">
                        <font-awesome-icon :icon="feature.icon" class="text-white"/>
                    </div>
                </div>
                <div v-else></div>
                <div class="aspect-square flex justify-center items-center hover:bg-gray-100 bg-red-500 hover:bg-red-600 transition-all ease-in-out p-2 rounded-xl text-white aspect-square">
                    <font-awesome-icon icon="fa-solid fa-remove" class="cursor-pointer" @click="destroy"/>
                </div>
            </div>
        </div>
    </div>
</template>