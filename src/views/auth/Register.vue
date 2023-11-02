<script setup>
import CustomButton from '../../components/buttons/CustomButton.vue';
import Container from '../../components/layout/Container.vue';
import { ref } from 'vue';
import Api from '../../services/Api';
import { useRouter } from 'vue-router';
import ErrorText from '../../components/functional/ErrorText.vue';
import PageHeader from '../../components/layout/PageHeader.vue';
import TextInput from '../../components/inputs/TextInput.vue';
import { backgrounds } from '../../services/Consts';
import { randomInt } from '../../services/Helpers';

const api = new Api();
const router = useRouter();

const background = backgrounds[randomInt(0, backgrounds.length-1)];

const config = ref({
    submitting: false,
    errors: []
})

const formData = ref({
    name: '',
    email: '',
    password: '',
    confirmPassword: ''
});

const handleSubmit = async ( e ) => {
    e.preventDefault();
    config.value.submitting = true;
    await api.register( formData.value.name, formData.value.email, formData.value.password, formData.value.confirmPassword )
        .then(( response ) => {
            router.push({ name: 'account-home' });
            config.value.submitting = false;
        })
        .catch(( error ) => {
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
                <div class="w-full flex-1 flex-col lg:grid lg:grid-cols-2 gap-5 py-10 px-5 inline-flex justify-center items-center">
                    <form @submit="handleSubmit">
                        <div class="inline-flex flex-col h-full justify-center gap-5 p-0 lg:px-16">
                            <div class="font-semibold text-3xl">Register</div>
                            <div class="flex-col inline-flex gap-3">
                                <TextInput v-model:value="formData.name" :errors="config.errors?.name" label="Name" @clear="config.errors.name = null" />
                            </div>
                            <div class="flex-col inline-flex gap-3">
                                <TextInput v-model:value="formData.email" type="email" :errors="config.errors?.email" label="Email" @clear="config.errors.email = null" />
                            </div>
                            <div class="flex-col inline-flex gap-3">
                                <TextInput v-model:value="formData.password" type="password" :errors="config.errors?.password" label="Password" @clear="config.errors.password = null" />
                            </div>
                            <div class="flex-col inline-flex gap-3">
                                <TextInput v-model:value="formData.confirmPassword" type="password" :errors="config.errors?.password" :hideErrorText="true" label="Confirm Password" @clear="config.errors.password = null" />
                            </div>
                            <div class="inline-flex justify-end pt-5">
                                <CustomButton text="register" :loading="config.submitting"/>
                            </div>
                            <div>
                                <div>
                                    already have an account? click <router-link class="underline" :to="{ name: 'login' }">here to login</router-link>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="w-full h-full rounded-3xl bg-right bg-cover hidden text-right p-4 lg:block" :style="{ backgroundImage: `url(${background})`}"></div>
                </div>
            </Container>
        </div>
    </div>
</template>