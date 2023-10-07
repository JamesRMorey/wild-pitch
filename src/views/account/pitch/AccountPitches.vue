<script setup>
import AccountLayout from '../../../components/layout/account/AccountLayout.vue';
import AccountPitchCard from '../../../components/account/AccountPitchCard.vue';
import Api from '../../../services/Api';
import { ref, onMounted } from 'vue';

const api = new Api();

const pitches = ref([]);

const getPitches = async () => {
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

const deletePitch = async ( id ) => {
    await api.deletePitch( id )
        .then(( response ) => {
            pitches.value.splice(pitches.value.findIndex(( pitch ) => pitch.id == id ), 1);
        })
        .catch(( error ) => {

        })
}

const pageButtons = ref([
    { text: 'add' , route: '/my-account/pitches/create' }
])

onMounted(() => {
    getPitches();
})


</script>

<template>
    <AccountLayout headerText="my pitches" subtitleText="manage, add, edit and remove your listings" :buttons="pageButtons">
        <div class="grid grid-cols-1 sm-grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5 md:px-8 mb-16">
            <AccountPitchCard v-for="( pitch, i ) in pitches" @destroy="deletePitch" :id="pitch.id" :description="pitch.description" :title="pitch.title" :img="pitch?.images[0]?.src"/>
        </div>  
    </AccountLayout>
</template>