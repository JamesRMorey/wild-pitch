<script setup>
import Api from '../../services/Api';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
import { onMounted } from 'vue';
import Logo from './Logo.vue';
import IconButton from '../buttons/IconButton.vue'

const api = new Api();
const router = useRouter();
const authStore = useAuthStore();

const logoutUser =  async() => {
    await api.logout()
    .then(( user ) => {
        authStore.setUser( user );
        router.push('/');
    })
    .catch(( error ) => {})
}

onMounted(() => {

})

</script>

<template>
    <header>
        <nav class="bg-white border-gray-200 px-6 lg:px-10 py-3.5 dark:bg-gray-800">
            <div class="flex justify-between items-center mx-auto max-w-screen-xl">
                <router-link :to="{ name: 'home' }"  class="flex items-center">
                    <Logo class="block dark:hidden"/>
                    <Logo class="block light:hidden" dark="true"/>
                </router-link>
                <div class="inline-flex items-center gap-3">
                    <IconButton icon="fa-user" @press="router.push({ name: 'account-home' })"/>
                    <div @click="logoutUser" v-if="authStore.user" class="cursor-pointer text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-xl text-sm px-4 lg:px-5 py-2 lg:py-2.5 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                        Log out
                    </div>
                    <router-link v-if="!authStore.user" to="/login" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                        Log in
                    </router-link>
                </div>
            </div>
        </nav>
    </header>
</template>
