<script setup>
import { useRoute } from 'vue-router';
import Api from '../services/Api';
import { useAuthStore } from '../stores/auth';

import { ref, onMounted, computed } from 'vue';
import PageLayout from '../components/layout/PageLayout.vue';
import PitchCard from '../components/pitches/PitchCard.vue';
import ImageGrid from '../components/image/ImageGrid.vue';
import NewsLetterSignUp from '../components/functional/NewsLetterSignUp.vue';
import TextCtaSplit from '../components/cta/TextCtaSplit.vue';
import BackBar from '../components/layout/BackBar.vue';
import PitchCardLoader from '../components/loaders/PitchCardLoader.vue';

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
});

const isLoaded = computed(() => {
    return Object.keys( profile.value ).length > 0;
});

</script>

<template>
    <PageLayout>
        <div class="pb-10 flex flex-col gap-6">
            <BackBar />
            <div class="flex flex-row gap-5">
                <img :src="dark ? '/logos/icon-white.webp' : '/logos/icon.webp'" class="h-24" alt="wild pitch logo"/>
                <div class="flex flex-col">
                    <div v-if="isLoaded" class="text-2xl">{{ profile.name }}</div>
                    <div v-else class="text-2xl bg-gray-100 rounded-xl text-transparent">name loading</div>
                    <div class="text-md">We think these pitches are pretty awesome.</div>
                    <div class="text-md">Create your own pitches <router-link :to="{ name: 'account-home' }" class="link">here</router-link>.</div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8 py-6 px-10">
                <PitchCard 
                    v-if="isLoaded"
                    v-for="( pitch, i ) in profile.pitches"
                    :title="pitch.title" 
                    :description="pitch.description" 
                    :img="pitch?.images[0]?.src" 
                    :pitchId="pitch.id" 
                    :is-saved="pitch.is_saved" 
                    :features="pitch.features"
                />
                <PitchCardLoader 
                    v-else
                    v-for="i in 10"
                />
            </div>
            <TextCtaSplit :cta-1="{ text: 'find out more', link: { name: 'register' } }" :cta-2="{ text: 'sign up now', link: { name: 'register' } }" title="Join The Wild Pitch Community!" text="Find your next adventure from one of our amazing members"  />
        </div>
    </PageLayout>
</template>
