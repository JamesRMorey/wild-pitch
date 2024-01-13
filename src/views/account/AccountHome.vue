<script setup>
import AccountLayout from '../../components/layout/account/AccountLayout.vue';

const menuItems = [
    {
        name: 'my pitches',
        subtitle: 'manage and create pitches',
        url: { name: 'account-pitches' },
        icon: 'fa-solid fa-tent'
    },
    {
        name: 'saved',
        subtitle: 'view your favourite pitches',
        url: { name: 'account-pitches-saved' },
        icon: 'fa-solid fa-heart'
    },
    {
        name: 'your details',
        subtitle: 'mange your account',
        url: { name: 'user-details' },
        icon: 'fa-solid fa-user'
    },
];

</script>

<template>
    <AccountLayout :show-back="false">   
        <div class="">
            <div>
                <div class="text-3xl">
                    Welcome back James Morey
                </div>
                <div>This is your account home, from here you can manage everything to do with your membership of the Wild Pitch community.</div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 pt-8">
                <router-link :to="item.url" v-for="(item, i) in menuItems" class="shadow hover:bg-gray-100 rounded-xl px-12 py-6 inline-flex items-start gap-5">
                    <font-awesome-icon :icon="item.icon" size="2x"/>
                    <div class="inline-flex flex-col">
                        <div class="text-xl capitalize">{{ item.name }}</div>
                        <div class="text-gray-400">{{ item.subtitle }}</div>
                    </div>
                </router-link> 
            </div>
            <div class="inline-flex justify-center items-center w-full pb-32 pt-16">
                <div 
                    class="w-64 aspect-square bg-center bg-cover"
                    style="background-image: url('/logos/icon.webp');"
                    ></div>
            </div>
        </div>         
    </AccountLayout>
</template>