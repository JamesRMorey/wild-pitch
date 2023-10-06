<script setup>
import { useRouter } from 'vue-router';
import PageHeader from '../components/layout/PageHeader.vue';
import PageFooter from '../components/layout/PageFooter.vue';
import BannerWithSearch from '../components/banners/BannerWithSearch.vue';

const router = useRouter();

const handleSearch = ( location ) => {
    console.log('handle search')
    router.push('/pitches?locationId=' + location.id + '&locationName=' + location.name);
}

</script>

<template>
    <PageHeader />
    <BannerWithSearch @search="handleSearch"/>
    <PageFooter />
</template>
