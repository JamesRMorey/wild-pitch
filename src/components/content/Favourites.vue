<script setup>
import { onMounted, ref, toRefs } from 'vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import Api from '../../services/Api';
import NoResults from '../functional/NoResults.vue';
import PitchCard from '../pitches/PitchCard.vue';

const api = new Api();

const props = defineProps({
    limit: {
        type: Number,
        required: false,
        default: 3
    }
});

const { limit } = toRefs(props);

const config = ref({
    loading: true,
    error: 'Oops, well this is embarassing, we don\'t have any favourites to show you.',
    showError: false
});

const favouritePitches = ref([]);

const getFavouritePitches = async () => {
    config.value.loading = true;
    await api.getFavouritePitches( limit )
        .then(( pitches ) => {
            favouritePitches.value = pitches ?? [];
            config.value.loading = false;
            config.value.showError = false;
        })
        .catch(( error ) => {
            config.value.loading = false;
            config.value.showError = true;
        })
}

onMounted(() => {
    getFavouritePitches();
})

</script>

<template>
    <div class="px-16 lg:px-32 inline-flex inline-flex items-center justify-center w-full">
        <div v-if="config.loading">
            <PulseLoader color="#000000"/>
        </div>
        <div v-else-if="config.showError">
            <NoResults :text="config.error" />
        </div>
        <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-12 w-full">
            <PitchCard v-for="(pitch, i) in favouritePitches" 
                :title="pitch.title" 
                :description="pitch.description" 
                :img="pitch.images[0].src" 
                :pitch-id="pitch.id"
                :features="pitch.features"
                :class="(i == limit-1 && limit%2 !== 0) ? 'hidden md:inline-flex' : ''"
                />
        </div>
    </div>
</template>