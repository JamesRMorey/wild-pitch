<script setup>
import { useRoute } from 'vue-router';
import Api from '../services/Api';
import { useAuthStore } from '../stores/auth';

import { ref, onMounted, watch } from 'vue';
import PageLayout from '../components/layout/PageLayout.vue';
import PitchCard from '../components/pitches/PitchCard.vue';
import ImageGrid from '../components/image/ImageGrid.vue';
import NewsLetterSignUp from '../components/functional/NewsLetterSignUp.vue';
import TextCtaSplit from '../components/cta/TextCtaSplit.vue';

const route = useRoute();
const api = new Api();
const { userId } = route.params;
const authStore = useAuthStore();

const profile = ref({});

const getProfile = async () => {
    await api.getUserProfile( userId )
        .then(( data ) => {
            profile.value = data
        })
        .catch(( error ) => {
            console.log( error )
        })
}

onMounted(() => {
    getProfile();
})

</script>

<template>
    <PageLayout>
        <div class="pb-10 flex flex-col gap-6">
            <div class="grid grid-cols-5 gap-5 py-6 px-10">
                <PitchCard 
                    v-for="( pitch, i ) in profile.pitches"
                    :title="pitch.title" 
                    :description="pitch.description" 
                    :img="pitch?.images[0]?.src" 
                    :pitchId="pitch.id" 
                    :is-saved="pitch.is_saved" 
                    :features="pitch.features"
                />
            </div>
            <TextCtaSplit :cta-1="{ text: 'find out more', link: { name: 'register' } }" :cta-2="{ text: 'sign up now', link: { name: 'register' } }" title="Join The Wild Pitch Community!" text="Find your next adventure from one of our amazing members"  />
        </div>
    </PageLayout>
</template>
