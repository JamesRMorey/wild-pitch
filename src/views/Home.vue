<script setup>
import { useRouter } from 'vue-router';
import PageHeader from '../components/layout/PageHeader.vue';
import PageFooter from '../components/layout/PageFooter.vue';
import BannerWithSearch from '../components/banners/BannerWithSearch.vue';

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
                    <img src="/logos/icon-white.png" class="block sm:hidden w-48" />
                    <img src="/logos/text-white.png" class="hidden sm:block sm:w-96"/>
                    <div class="text-white text-xl hidden sm:block ">A free community collection of the best wild camping spots in the UK</div>
                </div>
            </template>
        </BannerWithSearch>
        <div class="flex-1 flex"></div>
        <PageFooter />
    </div>
</template>
