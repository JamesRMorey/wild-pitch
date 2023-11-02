<script setup>
import { useRouter } from 'vue-router';
import PageHeader from '../components/layout/PageHeader.vue';
import PageFooter from '../components/layout/PageFooter.vue';
import BannerWithSearch from '../components/banners/BannerWithSearch.vue';
import TextImageSplit from '../components/content/TextImageSplit.vue';
import Container from '../components/layout/Container.vue';

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
                    <img src="/logos/icon-white.png" class="block w-64" />
                </div>
            </template>
        </BannerWithSearch>
        <Container>
            <TextImageSplit 
                text="Wild Pitch is a community collection of the best wild camping spots in the UK. We always found it a stuggle searching facebook groups and forums to find a good spot for our next trip, and so, Wild Pitch was born! Our service is totally free to use. All our pitches are verified to the best of our ability by our admin team to ensure you get the best experience when using our service." 
                image="/backgrounds/square/square_3.webp" 
                title="About Us"
                />
            <div class="flex-1 flex"></div>
        </Container>
        <PageFooter />
    </div>
</template>
