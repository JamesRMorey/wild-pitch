<script setup>
import CustomButton from '../../components/buttons/CustomButton.vue';
import Container from '../../components/layout/Container.vue';
import { ref } from 'vue';
import Api from '../../services/Api';
import { useRoute, useRouter } from 'vue-router';
import { useAuthStore } from '../../stores/auth';
import PageHeader from '../../components/layout/PageHeader.vue';
import TextInput from '../../components/inputs/TextInput.vue';
import PageFooter from '../../components/layout/PageFooter.vue';

const api = new Api();
const router = useRouter();
const route = useRoute();
const { token } = route.params;
const { email } = route.query;

const config = ref({
    submitting: false,
    errors: [],
    success: []
});

const formData = ref({
    email: email,
    password: '',
    confirmPassword: '',
    token: token,
});

const handleSubmit = async ( e ) => {
    e.preventDefault();
    config.value.submitting = true;
    await api.resetPassword( formData.value.email, formData.value.password, formData.value.confirmPassword, formData.value.token )
        .then(( response ) => {
            config.value.errors = [];
            config.value.submitting = false;
            router.push({ name: 'login' })
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
                <div class="w-full flex-1 flex-col gap-5 py-10 px-5 items-center inline-flex justify-center">
                    <div class="inline-flex flex-col w-full sm:w-96 justify-center item-center gap-5">
                        <div class="rounded-2xl w-full flex-col inline-flex gap-5">
                            <form @submit="handleSubmit" class="flex-col inline-flex gap-5">
                                <div class="flex-col inline-flex gap-3">
                                    <TextInput class="w-full sm:w-96" v-model:value="formData.password" label="New Password" :errors="config.errors?.password" type="password" @clear="config.errors.password = null"/>
                                    <TextInput class="w-full sm:w-96" v-model:value="formData.confirmPassword" label="Confirm Password" :errors="config.errors?.password" type="password" @clear="config.errors.password = null"/>
                                </div>
                                <div class="inline-flex justify-end pt-5">
                                    <CustomButton text="reset" :loading="config.submitting"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </Container>
        </div>
        <PageFooter />
    </div>
</template>