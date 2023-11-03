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
    <div class="w-full inline-flex flex-col gap-3 justify-center bg-center bg-cover">
        <router-link :to="'/pitches/pitch/' + id" class="w-full rounded-xl bg-center bg-cover aspect-square" :style="{ backgroundImage: `url(${img})`}">
        </router-link>
        <div class="inline-flex flex-col gap-3">
            <div class="inline-flex flex-col">
                <div class="text-lg font-semibold capitalize truncate ...">{{ title }}</div>
                <div class="text-grey truncate ...">{{ description }}</div>
            </div>
            <div class="inline-flex gap-3 justify-between">
                <div class="inline-flex">
                    <div v-if="features.length" class="inline-flex gap-1 items-end px-2 truncate ...">
                        <div v-for="( feature, i ) in features.slice(0,6)">
                            <font-awesome-icon :icon="feature.icon" />
                        </div>
                    </div>
                    <div v-else></div>
                </div>
                <div class="inline-flex gap-2">
                    <router-link :to="'/pitches/pitch/' + id"  class="">
                        <font-awesome-icon icon="fa-solid fa-eye" class="cursor-pointer" />
                    </router-link>
                    <div class="">
                        <font-awesome-icon icon="fa-solid fa-remove" class="cursor-pointer" @click="destroy"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>