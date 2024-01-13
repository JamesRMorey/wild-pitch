<script setup>
import CustomButton from '../../components/buttons/CustomButton.vue';
import Container from '../../components/layout/Container.vue';
import { ref } from 'vue';
import Api from '../../services/Api';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
import PageHeader from '../../components/layout/PageHeader.vue';
import TextInput from '../../components/inputs/TextInput.vue';
import { randomInt } from '../../services/Helpers';
import { backgrounds } from '../../services/Consts';

const api = new Api();
const router = useRouter();
const authStore = useAuthStore();

const background = backgrounds[randomInt(0, backgrounds.length-1)];

const config = ref({
    submitting: false,
    errors: []
});

const formData = ref({
    email: '',
    password: ''
});

const handleSubmit = async ( e ) => {
    e.preventDefault();
    config.value.submitting = true;
    await api.login( formData.value.email, formData.value.password )
        .then(async ( user ) => {
            await authStore.setUser( user );
            router.push({ name: 'account-home' });
            config.value.errors = [];
            config.value.submitting = false;
        })
        .catch(( error ) => {
            authStore.clearUser();
            config.value.errors = error.errors;
            config.value.submitting = false;
        });
}
    
</script>

<template>
    <div class="h-screen flex flex-col">
        <PageHeader />
        <div class="flex flex-1">
            <Container>
                <div class="w-full flex-1 flex-col lg:grid lg:grid-cols-2 gap-5 py-10 px-5 justify-center items-center inline-flex">
                    <div class="w-full h-full rounded-3xl bg-left bg-cover hidden lg:block text-right p-4" :style="{ backgroundImage: `url(${background})`}"></div>
                    <form @submit="handleSubmit">
                        <div class="inline-flex flex-col h-full justify-center gap-5 px-0 lg:px-16">
                            <div class="font-semibold text-3xl">Login</div>
                            <div class="flex-col inline-flex gap-3">
                                <TextInput v-model:value="formData.email" label="Email" :errors="config.errors?.email" type="email" @clear="config.errors.email = null"/>
                            </div>
                            <div class="flex-col inline-flex gap-3">
                                <TextInput v-model:value="formData.password" label="Password" :errors="config.errors?.password" type="password" @clear="config.errors.password = null"/>
                            </div>
                            <div class="text-right">
                                <router-link class="underline" :to="{ name: 'forgot-password' }">forgot password?</router-link>
                            </div>
                            <div class="inline-flex justify-end pt-5">
                                <CustomButton text="Login" :loading="config.submitting"/>
                            </div>
                            <div>
                                <div>
                                    dont have an account? click <router-link class="underline" :to="{ name: 'register' }">here to register</router-link>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </Container>
        </div>
    </div>
</template>