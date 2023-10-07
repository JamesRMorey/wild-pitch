<script setup>
import AccountLayout from '../../components/layout/account/AccountLayout.vue';
import { onMounted } from 'vue';
import Api from '../../services/Api';

const api = new Api();

const menuItems = [
    {
        name: 'my pitches',
        subtitle: 'manage your pitches, edit and create more',
        url: '/my-account/pitches',
        icon: 'fa-solid fa-tent'
    },
    {
        name: 'saved',
        subtitle: 'view your favourite pitches',
        url: '/my-account/pitches',
        icon: 'fa-solid fa-heart'
    },
    {
        name: 'gallery',
        subtitle: 'take a look back at all your amazing images',
        url: '/my-account/pitches',
        icon: 'fa-solid fa-camera-retro'
    },
];

const getUser = async () => {
    await api.getUser()
        .then(( response ) => {
            console.log( response );
        })
        .catch(( error ) => {
            console.log(error);
        });
}

onMounted(() => {
    getUser();
})

</script>

<template>
    <AccountLayout>   
        <div class="">
            <div>
                <div class="text-3xl">
                    Welcome back James Morey
                </div>
                <div>This is your account home, from here you can manage everything to do with your membership of the Wild Pitch community.</div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 pb-32 pt-8">
                <router-link :to="item.url" v-for="(item, i) in menuItems" class="shadow hover:bg-gray-100 rounded-xl p-8 inline-flex items-start gap-5">
                    <font-awesome-icon :icon="item.icon" size="2x"/>
                    <div class="inline-flex flex-col">
                        <div class="text-xl capitalize">{{ item.name }}</div>
                        <div class="text-gray-400">{{ item.subtitle }}</div>
                    </div>
                </router-link> 
            </div>
        </div>         
    </AccountLayout>
</template>