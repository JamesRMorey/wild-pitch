<script setup>
import AccountLayout from '../../../components/layout/account/AccountLayout.vue';
import Api from '../../../services/Api';
import { ref, onMounted } from 'vue';
import PitchCard from '../../../components/pitches/PitchCard.vue';

const api = new Api();

const pitches = ref([]);

const getSavedPitches = async () => {
    await api.getSavedPitches()
        .then(( response ) => {
            updatePitches( response );
        })
        .catch(( error ) => {
            console.log( error );
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
    <AccountLayout headerText="saved pitches" subtitleText="your collection of your favourite pitches">
        <div class="grid grid-cols-1 sm-grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5 md:px-8 mb-16">
            <PitchCard v-for="( pitch, i ) in pitches" :pitchId="pitch.id" :description="pitch.description" :title="pitch.title" :img="pitch?.images[0]?.src" :isSaved="pitch.is_saved" :features="pitch.features"/>
        </div>  
    </AccountLayout>
</template>