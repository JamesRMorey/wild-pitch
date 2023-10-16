<script setup>
import AccountLayout from '../../../components/layout/account/AccountLayout.vue';
import Api from '../../../services/Api';
import { ref, onMounted } from 'vue';
import PitchCard from '../../../components/pitches/PitchCard.vue';
import NoResults from '../../../components/functional/NoResults.vue';

const api = new Api();

const config = ref({
    loading: true
})
const pitches = ref([]);

const getSavedPitches = async () => {
    await api.getSavedPitches()
        .then(( response ) => {
            updatePitches( response );
            config.value.loading = false;
        })
        .catch(( error ) => {
            console.log( error );
            config.value.loading = false;
        })
}

const updatePitches = ( data ) => {
    pitches.value = data;
}

onMounted(() => {
    getSavedPitches();
})


</script>

<template>
    <AccountLayout headerText="saved pitches" subtitleText="your collection of your favourite pitches" :loading="config.loading">
        <div v-if="pitches.length" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5 md:px-8 mb-16">
            <PitchCard v-for="( pitch, i ) in pitches" :pitchId="pitch.id" :description="pitch.description" :title="pitch.title" :img="pitch?.images[0]?.src" :isSaved="pitch.is_saved" :features="pitch.features"/>
        </div>  
        <div v-else class="inline-flex justify-center items-center w-full">
            <NoResults :text="'You haven\'t saved any pitches, click the heart icon on a pitch to save it.'" />
        </div>
    </AccountLayout>
</template>