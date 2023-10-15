<script setup>
import AccountLayout from '../../components/layout/account/AccountLayout.vue';
import { onMounted, ref } from 'vue';
import Api from '../../services/Api';
import TextInput from '../../components/inputs/TextInput.vue';
import CustomButton from '../../components/buttons/CustomButton.vue';
import Modal from '../../components/modals/Modal.vue';
import { useRouter } from 'vue-router';

const api = new Api();
const router = useRouter();

const user = ref({
    name: ''
});

const config = ref({
    submitting: false,
    loaded: false,
    errors: []
})

const modal = ref({
    show: false
})

const getUser = async () => {
    await api.getUser()
        .then(( response ) => {
            console.log(response)
            user.value = response;
            config.value.loaded = true;
        })
        .catch(( error ) => {
            config.value.loaded = true;
        })
}

const handleSubmit = async ( e ) => {
    e.preventDefault();
    config.value.submitting = true;
    await api.updateUser( user.value )
        .then(( response ) => {
            console.log(response);
            config.value.submitting = false;
            router.push({ name: 'account-home' })
        })
        .catch(( error ) => {
            config.value.submitting = false;
            config.value.errors = error.errors;
        })
}

const deleteUser = async () => {
    await api.deleteUser()
        .then(( response ) => {
            router.push({ name: 'home' })
        })
        .catch(( error ) => {
            
        })
}

const handleDeletePress = () => {
    modal.value.show = true;
}

onMounted(() => {
    getUser();
})


</script>

<template>
    <AccountLayout headerText="your account" subtitleText="manage, edit and remove your details">   
        <div class="inline-flex justify-center items-center">
            <div class="bg-white shadow rounded-2xl p-8 inline-flex gap-6">
                <form @submit="handleSubmit" class="inline-flex flex-col gap-5">
                    <TextInput v-if="config.loaded" v-model:value="user.name" label="Name" :errors="config.errors.name" @clear="config.errors.name = null"/>
                    <TextInput v-else label="Name" value=""/>
                    <TextInput v-if="config.loaded" v-model:value="user.email" label="Email" :errors="config.errors.email" @clear="config.errors.email = null"/>
                    <TextInput v-else label="Email" value=""/>
                    <div class="inline-flex mt-6">
                        <CustomButton text="Update" :loading="config.submitting"/>
                    </div>
                </form>
                <div class="inline-flex justify-between items-center flex-col bg-gray-100 p-5 rounded-2xl">
                    <img src="/logos/icon.png" class="h-32" />
                    <CustomButton text="Delete Account" @press="handleDeletePress"/>
                </div>
            </div>
        </div>
        <!-- <div class="inline-flex justify-end items-end">
                    <CustomButton text="Delete Account" @press="handleDeletePress"/>
                </div> -->
        <Modal v-if="modal.show" @close="modal.show = false" @confirm="deleteUser()" confirmText="yep, i'm off, cya!">
            <template v-slot:title>
                <div class="text-lg font-semibold">Woah! Hold on a sec</div>
            </template>
            <template v-slot:content>
                <div class="w-full">
                    Are you sure you want to delete <span class="font-semibold">YOURSELF?</span>
                </div>
            </template>
        </Modal>
    </AccountLayout>
</template>