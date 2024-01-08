<script setup>
import Api from '../../services/Api';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
import { onMounted, ref } from 'vue';
import Logo from './Logo.vue';
import IconButton from '../buttons/IconButton.vue'
import Modal from '../modals/Modal.vue';
import MessageStream from '../functional/MessageStream.vue';

const api = new Api();
const router = useRouter();
const authStore = useAuthStore();

const config = ref({
    loading: false
})
const modal = ref({
    show: false
})

const headerIsSticky = ref(false);

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
    document.addEventListener('scroll', handleScroll);
});

const handleScroll = ( e ) => {
    const threshold = window.innerHeight/4;
    if ( headerIsSticky.value == true && window.scrollY > threshold ) return;

    if ( window.scrollY > threshold ) {
        headerIsSticky.value = true;
    } else {
        headerIsSticky.value = false
    }
}

</script>

<template>
    <header>
        <nav class="bg-white border-gray-200">
            <!-- main header -->
            <div class="bg-white z-100 w-full px-6 lg:px-10 shadow z-[1000] py-4"
            >
                <div class="flex justify-between items-center mx-auto max-w-screen-xl">
                    <router-link :to="{ name: 'home' }" aria-label="home" class="flex items-center">
                        <Logo/>
                    </router-link>
                    <div class="inline-flex items-center gap-3">
                        <router-link :to="{ name: 'pitch-listing' }" aria-label="pitch listing" class="hidden md:block text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                            Find A Pitch
                        </router-link>
                        <IconButton icon="fa-user" @press="router.push({ name: 'account-home' })" aria-label="go to my account"/>
                        <div tabindex="0" @click="() => modal.show = true" v-if="authStore.user" class="cursor-pointer text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-xl text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                            Log out
                        </div>
                        <router-link v-if="!authStore.user" :to="{ name: 'login' }" aria-label="login" class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                            Log in
                        </router-link>
                    </div>
                </div>
            </div>
            <!-- sticky header -->
            <div class="fixed top-0 bg-white z-100 w-full px-6 lg:px-10 shadow transition-all ease-in z-[10000] py-2"
                :class="headerIsSticky ? 'opacity-100' : 'opacity-0'"
            >
                <div class="flex justify-between items-center mx-auto max-w-screen-xl">
                    <router-link :to="{ name: 'home' }" aria-label="home" class="flex items-center">
                        <Logo/>
                    </router-link>
                    <div class="inline-flex items-center gap-3">
                        <router-link :to="{ name: 'pitch-listing' }" aria-label="pitch listing" class="hidden md:block text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                            Find A Pitch
                        </router-link>
                        <IconButton icon="fa-user" @press="router.push({ name: 'account-home' })" aria-label="go to my account"/>
                        <div tabindex="0" @click="() => modal.show = true" v-if="authStore.user" class="cursor-pointer text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-xl text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                            Log out
                        </div>
                        <router-link v-if="!authStore.user" :to="{ name: 'login' }" aria-label="login" class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 focus:outline-none">
                            Log in
                        </router-link>
                    </div>
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

        <MessageStream />
    </header>
</template>
