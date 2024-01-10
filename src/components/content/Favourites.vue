<script setup>
import { onMounted, ref, toRefs } from 'vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import Api from '../../services/Api';
import NoResults from '../functional/NoResults.vue';
import PitchSlider from '../sliders/PitchSlider.vue';

const api = new Api();

const props = defineProps({
    limit: {
        type: Number,
        required: false,
        default: 6
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

            if ( pitches.length == 0 ) {
                config.value.showError = true;
                return;
            }
            config.showError = false;
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
    <div class="inline-flex inline-flex items-center justify-center w-full">
        <div v-if="config.loading">
            <PulseLoader color="#000000" />
        </div>
        <div v-else-if="config.showError">
            <NoResults :text="config.error" />
        </div>
        <div class="w-full flex flex-col gap-4">
            <PitchSlider :pitches="favouritePitches"/>
        </div>
    </div>
</template>