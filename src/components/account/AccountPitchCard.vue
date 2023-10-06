<script setup>
import { toRefs } from 'vue';
import Api from '../../services/Api';

const emit = defineEmits([ 'edit', 'destroy' ]);

const api = new Api();

const props = defineProps({
    id: {
        type: String,
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
    // emit( 'destroy', id );
    await api.deletePitch( id.value )
        .then(( response ) => {

        })
        .catch(( error ) => {

        })
}
</script>

<template>
    <div class="w-full inline-flex flex-col gap-3 justify-center bg-center bg-cover">
        <div class="w-full rounded-xl bg-center bg-cover aspect-square" :style="{ backgroundImage: `url(${img})`}">
        </div>
        <div class="inline-flex flex-col">
            <div class="text-lg font-semibold capitalize truncate ...">{{ title }}</div>
            <div class="text-grey truncate ...">{{ description }}</div>
            <div class="inline-flex gap-3 justify-end">
                <router-link to="/my-account/pitches/create" class="mt-5 underline text-right">
                    <font-awesome-icon icon="fa-solid fa-add" />
                </router-link>
                <router-link to="/pitch" class="mt-5 underline text-right">
                    <font-awesome-icon icon="fa-solid fa-edit" />
                </router-link>
                <div class="mt-5 underline text-right">
                    <font-awesome-icon icon="fa-solid fa-remove" class="cursor-pointer" @click="destroy"/>
                </div>
            </div>
        </div>
    </div>
</template>