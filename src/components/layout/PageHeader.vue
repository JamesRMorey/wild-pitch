<script setup>
import Api from '../../services/Api';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
import { onMounted, ref } from 'vue';
import Logo from './Logo.vue';
import IconButton from '../buttons/IconButton.vue'
import Modal from '../modals/Modal.vue';

const api = new Api();
const router = useRouter();
const authStore = useAuthStore();

const config = ref({
    loading: false
})
const modal = ref({
    show: false
})

const closeConfirmModal = async () => {
    modal.value.show = false;
}

const logoutUser =  async () => {
    config.value.loading = true;
    await api.logout()
    .then(( user ) => {
        authStore.setUser( null );
        config.value.loading = false;
        router.push('/');
    })
    .catch(( error ) => {
        config.value.loading = false;
    })
}

onMounted(() => {

})

</script>

<template>
    <header>
        <nav class="bg-white border-gray-200 px-6 lg:px-10 py-3.5">
            <div class="flex justify-between items-center mx-auto max-w-screen-xl">
                <router-link :to="{ name: 'home' }"  class="flex items-center">
                    <Logo/>
                </router-link>
                <div class="inline-flex items-center gap-3">
                    <IconButton icon="fa-user" @press="router.push({ name: 'account-home' })"/>
                    <div @click="() => modal.show = true" v-if="authStore.user" class="cursor-pointer text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-xl text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                        Log out
                    </div>
                    <router-link v-if="!authStore.user" to="/login" class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                        Log in
                    </router-link>
                </div>
            </div>
            <Modal v-if="modal.show" @close="closeConfirmModal" @confirm="logoutUser" confirmText="log out" :loading="config.loading">
                <template v-slot:title>
                    <div class="text-lg font-semibold">Woah! Hold on a sec</div>
                </template>
                <template v-slot:content>
                    <div class="w-full">
                        Are you sure you want to logout?
                    </div>
                </template>
            </Modal>
        </nav>
    </header>
</template>
