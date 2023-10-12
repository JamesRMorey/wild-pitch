<script setup>
import CustomButton from '../../components/buttons/CustomButton.vue';
import Container from '../../components/layout/Container.vue';
import { ref } from 'vue';
import Api from '../../services/Api';
import { useRouter } from 'vue-router';
import ErrorText from '../../components/functional/ErrorText.vue';
import PageHeader from '../../components/layout/PageHeader.vue';
import TextInput from '../../components/inputs/TextInput.vue';

const api = new Api();
const router = useRouter();

const images = [
    'https://snowdonia.gov.wales/wp-content/uploads/2022/01/NVW-C11-1516-0041.jpg',
    'https://i0.wp.com/www.mudandroutes.com/wp-content/uploads/2011/11/moel_11_179_960.jpg?w=1063&h=797&ssl=1',
    'https://uploads-ssl.webflow.com/5e9741806e8dc26f407c3536/60536c1863348825e58d9599_Wild%20Camping%20in%20Snowdonia%20Trip%20-%20Cover%20Image%20-%20Compressed.jpg',
    'https://skipandjump.co.uk/wp-content/uploads/2020/09/a7538-img_9987-edit.jpg',
    'https://www.theordinaryadventurer.com/wp-content/uploads/2016/09/P5290068.jpg',
    'https://www.theordinaryadventurer.com/wp-content/uploads/2016/09/P5290068.jpg'
];

const background = images[Math.floor(Math.random() * (images.length - 0 + 1)) + 0];

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
                <div class="w-full flex-1 flex-col md:grid md:grid-cols-2 gap-5 py-10 px-5">
                    <form @submit="handleSubmit">
                        <div class="inline-flex flex-col h-full justify-center item-center gap-5 px-16">
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
                                <TextInput v-model:value="formData.confirmPassword" :errors="config.errors?.password" :hideErrorText="true" label="Confirm Password" @clear="config.errors.password = null" />
                            </div>
                            <div class="inline-flex justify-end pt-5">
                                <CustomButton text="register" :loading="config.submitting"/>
                            </div>
                            <div>
                                <div>
                                    already have an account? click <router-link class="underline" to="/register">here to login</router-link>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="w-full h-full rounded-3xl bg-center bg-cover hidden md:block text-right p-4" :style="{ backgroundImage: `url(${background})`}"></div>
                </div>
            </Container>
        </div>
    </div>
</template>