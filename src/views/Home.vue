<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import PageHeader from '../components/layout/PageHeader.vue';
import PageFooter from '../components/layout/PageFooter.vue';
import BannerWithSearch from '../components/banners/BannerWithSearch.vue';
import TextImageSplit from '../components/content/TextImageSplit.vue';
import Container from '../components/layout/Container.vue';
import BannerSlim from '../components/banners/BannerSlim.vue';
import HeaderWithText from '../components/content/headers/HeaderWithText.vue';
import Favourites from '../components/content/Favourites.vue';
import Header from '../components/content/Header.vue';
import IconBoxes from '../components/content/IconBoxes.vue';
import ImageWithBoxGrid from '../components/content/ImageWithBoxGrid.vue';
import TextCtaSplit from '../components/cta/TextCtaSplit.vue';
import NewsLetterSignUp from '../components/functional/NewsLetterSignUp.vue';

const router = useRouter();

const handleSearch = ( location ) => {
    if ( location.id ) {
        router.push('/pitches?locationId=' + location.id );
    } else {
        router.push('/pitches')
    }
}

const featureBoxes = ref([
    { text: 'Amazing Pitches', icon: 'fa-tent', link: 'pitch-listing' },
    { text: 'Upload Your Own', icon: 'fa-house-flag', link: 'account-home' },
    { text: 'Find A New Spot', icon: 'fa-binoculars', link: 'pitch-listing' },
    { text: 'Gear Reviews', icon: 'fa-person-hiking', link: 'account-home' },
    { text: 'Journal', icon: 'fa-book', link: 'account-home' },
    { text: 'Trip Ideas', icon: 'fa-face-grin-stars', link: 'account-home' },
    { text: 'Our Favourite Spots', icon: 'fa-heart', link: 'account-home' },
]);

const topLocationsBoxes = ref([
    { title: 'The Lake District', text: 'Picturesque lakes, rolling mountains, and charming valleys, attracting hikers, boaters, and nature enthusiasts.', icon: 'fa-water', link: 'pitch-listing', buttonText: 'View Pitches', image: '/images/lake_district_1.webp', locationId: 35665 },
    { title: 'Dartmoor', text: 'Known for vast open moorlands, granite tors, and ancient ruins, perfect for exploring nature\'s wild side.', icon: 'fa-binoculars', link: 'pitch-listing', buttonText: 'View Pitches', image: '/images/dartmoor_camping_1.webp', locationId: 17981 },
    { title: 'Snowdonia National Park', text: 'Majestic mountains, deep valleys, and serene lakes, offering adventure and stunning camping spots.', icon: 'fa-mountain', link: 'pitch-listing', buttonText: 'View Pitches', image: '/images/tryfan_1.webp', locationId: 57159 },
    { title: 'The Peak District', text: 'Features rolling hills, limestone valleys, and gritstone edges, ideal for hiking, climbing and camping.', icon: 'fa-cow', link: 'pitch-listing', buttonText: 'View Pitches', image: '/images/peaks_1.webp', locationId: 48740 },
])

const handleBoxPress = ( i ) => {
    const boxPressed = topLocationsBoxes.value[i];
    handleSearch( { id: boxPressed.locationId } );
}

</script>

<template>
    <div class="flex flex-col min-h-screen">
        <PageHeader />
        <BannerWithSearch @search="handleSearch">
            <template v-slot:content>
                <div class="inline-flex justify-center items-center flex-col gap-6">
                    <img src="/logos/icon-white.webp" class="block w-64" alt="logo image"/>
                </div>
            </template>
        </BannerWithSearch>
        <Container class="py-12">
            <div class="flex flex-col gap-12">
                <div class="flex flex-col gap-8">
                    <IconBoxes title="Join Our Community" text="Why you need to sign up to wild pitch :)" :boxes="featureBoxes"/>
                    <hr/>
                </div>
                <TextImageSplit 
                    text="Wild Pitch is a community collection of the best wild camping spots in the UK. <br/><br/> We always found it a stuggle searching facebook groups and forums to find a good spot for our next trip, and so, Wild Pitch was born! <br/><br/> Our service is totally free to use, so why not create an account and upload some of your favourite spots?" 
                    image="/backgrounds/square/square_2.webp" 
                    title="Wild Pitch"
                />
                <div class="inline-flex flex-col">
                    <TextCtaSplit :cta-1="{ text: 'find out more', link: { name: 'register' } }" :cta-2="{ text: 'sign up now', link: { name: 'register' } }" title="Join The Wild Pitch Community!" text="Find your next adventure from one of our amazing members" />
                </div>
            </div>
        </Container>
        <BannerSlim title="Your Next Adventure" :link="{ name: 'pitch-listing' }"/>
        <Container class="py-12">
            <div class="flex flex-col gap-12">
                <div class="gap-12 inline-flex flex-col">
                    <HeaderWithText title="Some of our favourites" text="Check out some our admin teams favourite pitches. Theses are places we've visited ourselves and loved so much we wanted to share them with you."/>
                    <Favourites />
                </div>
                <hr/>
                <ImageWithBoxGrid :boxes="topLocationsBoxes" image="/backgrounds/square/square_2.webp" @boxPress="handleBoxPress"/>
                <NewsLetterSignUp />
            </div>
        </Container>
        <PageFooter />
    </div>
</template>
