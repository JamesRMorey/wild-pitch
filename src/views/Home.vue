<script setup>
import { useRouter } from 'vue-router';
import PageHeader from '../components/layout/PageHeader.vue';
import PageFooter from '../components/layout/PageFooter.vue';
import BannerWithSearch from '../components/banners/BannerWithSearch.vue';

const router = useRouter();

const handleSearch = ( location ) => {
    if ( location.id ) {
        router.push('/pitches?locationId=' + location.id + '&locationName=' + location.name);
    } else {
        router.push('/pitches')
    }
}

</script>

<template>
    <div class="flex flex-col min-h-screen">
        <PageHeader />
        <BannerWithSearch @search="handleSearch" title="Wild Pitch" sub-title="A free community collection of the best wild camping spots in the UK"/>
        <div class="flex-1 flex"></div>
        <PageFooter />
    </div>
</template>
