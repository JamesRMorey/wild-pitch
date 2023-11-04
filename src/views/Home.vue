<script setup>
import { useRouter } from 'vue-router';
import PageHeader from '../components/layout/PageHeader.vue';
import PageFooter from '../components/layout/PageFooter.vue';
import BannerWithSearch from '../components/banners/BannerWithSearch.vue';
import TextImageSplit from '../components/content/TextImageSplit.vue';
import Container from '../components/layout/Container.vue';
import BannerSlim from '../components/banners/BannerSlim.vue';
import HeaderWithText from '../components/content/HeaderWithText.vue';
import Favourites from '../components/content/Favourites.vue';

const router = useRouter();

const handleSearch = ( location ) => {
    if ( location.id ) {
        router.push('/pitches?locationId=' + location.id );
    } else {
        router.push('/pitches')
    }
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
        <Container class="px-5 py-6">
            <TextImageSplit 
                text="Wild Pitch is a community collection of the best wild camping spots in the UK. We always found it a stuggle searching facebook groups and forums to find a good spot for our next trip, and so, Wild Pitch was born! Our service is totally free to use, so why not create an account and upload some of your favourite spots?" 
                image="/backgrounds/square/square_2.webp" 
                title="Wild Pitch"
            />
            <TextImageSplit 
                text="We rely on our community of campers to upload the UK's finest spots. If you have an amazing pitch, or have just come back from an awesome trip and you'd like to let the UK know about it, this is the place to do it. All our pitches are verified to the best of our ability by our admin team to ensure you get the best experience when using our service." 
                image="/backgrounds/square/square_3.webp" 
                title="Community"
                :inverted="true"
            />
            <TextImageSplit 
                text="We are a small team of weekend wild camping enthusiasts! We love everything about getting outdoors, we just found it a little harder than it should be to find a great spot. " 
                image="/backgrounds/square/square_1.webp" 
                title="About Us"
            />
            <div class="flex-1 flex"></div>
        </Container>
        <BannerSlim title="Find Your Next Pitch" :link="{ name: 'pitch-listing' }"/>
        <Container>
            <HeaderWithText title="Some of our favourites" text="Check out some our admin teams favourite pitches. Theses are places we've visited ourselves and loved so much we wanted to share them with you."/>
            <Favourites />
        </Container>
        <PageFooter />
    </div>
</template>
