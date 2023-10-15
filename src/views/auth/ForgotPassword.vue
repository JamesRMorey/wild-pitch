<script setup>
import CustomButton from '../../components/buttons/CustomButton.vue';
import Container from '../../components/layout/Container.vue';
import { ref } from 'vue';
import Api from '../../services/Api';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
import PageHeader from '../../components/layout/PageHeader.vue';
import TextInput from '../../components/inputs/TextInput.vue';
import PageFooter from '../../components/layout/PageFooter.vue';
import Alert from '../../components/functional/Alert.vue';

const api = new Api();
const router = useRouter();

const config = ref({
    submitting: false,
    errors: [],
    success: [],
    message: '',
    showLogin: false
});

const formData = ref({
    email: '',
});

const handleSubmit = async ( e ) => {
    e.preventDefault();
    config.value.submitting = true;
    await api.forgotPassword( formData.value.email )
        .then(( response ) => {
            config.value.errors = [];
            config.value.submitting = false;
            config.value.message = response.status ?? 'A password reset email has been sent to your inbox'
            config.value.showLogin = true;
        })
        .catch(( error ) => {
            config.value.errors = error.errors;
            config.value.submitting = false;
            config.value.showLogin = false;
        });
}
    
</script>

<template>
    <div class="h-screen flex flex-col">
        <PageHeader />
        <div class="flex flex-1">
            <Container>
                <div class="w-full flex-1 flex-col gap-5 py-10 px-5 items-center inline-flex justify-center">
                    <div class="inline-flex flex-col justify-center item-center gap-5 px-16">
                        <div class="shadow rounded-2xl p-8 flex-col inline-flex gap-5">
                            <form @submit="handleSubmit" class="flex-col inline-flex gap-5">
                                <Alert v-if="config.message" :text="config.message" />
                                <div class="flex-col inline-flex gap-3">
                                    <TextInput class="w-96" v-model:value="formData.email" label="Email" :errors="config.errors?.email" type="email" @clear="config.errors.email = null"/>
                                </div>
                                <div v-if="!config.showLogin" class="inline-flex justify-end pt-5">
                                    <CustomButton  text="submit" :loading="config.submitting"/>
                                </div>
                            </form>
                            <router-link v-if="config.showLogin" :to="{ name: 'login' }" class="inline-flex justify-start pt-5">
                                <CustomButton text="login"/>
                            </router-link>
                        </div>
                    </div>
                </div>
            </Container>
        </div>
        <PageFooter />
    </div>
</template>