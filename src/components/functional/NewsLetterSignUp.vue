<script setup>
import { ref } from 'vue';
import TextInput from '../inputs/TextInput.vue';
import Api from '../../services/Api';
import CustomButton from '../buttons/CustomButton.vue';

const api = new Api();

const config = ref({
    submitting: false,
    submitted: false,
    errors: null
})

const data = ref({
    email: ''
})

const handleSubmit = async ( e ) => {
    e.preventDefault();
    config.value.submitting = true;
    await api.signUpNewsletter( data.value.email )
        .then(( response ) => {
            config.value.submitted = true
            config.value.submitting = false;
        })
        .catch(( error ) => {
            console.log( error );
            config.value.errors = error.response.data.errors;
            config.value.submitting = false;
        })
}

</script>

<template>
    <div class="bg-gray-800 px-12 py-32 rounded-3xl flex flex-col lg:flex-row justify-between gap-10">
        <div>
            <div v-if="config.submitted === false" class="flex-col grow shrink basis-0 gap-2 flex" >
                <div class="text-white text-3xl font-bold">
                    Join Our Newsletter List!
                </div>
                <div class="text-white text-lg">
                    Camping gear offers, reviews, tips and <router-link :to="{ name: 'home' }" class="link">Wild Pitch Community Trips</router-link>. It could all be yours :)
                </div>
            </div>
            <div v-else class="flex-col grow shrink basis-0 gap-2 flex" >
                <div class="text-white text-3xl font-bold">
                    Thankyou For Joining Our Community!
                </div>
                <div class="text-white text-lg">
                    Camping gear offers, reviews, tips and <router-link :to="{ name: 'home' }" class="link">Wild Pitch Community Trips</router-link>. We hope to see you soon :)
                </div>
            </div>
        </div>
        <form v-if="config.submitted === false" @submit="handleSubmit" class="flex items-start gap-4 flex flex-col">
            <div class="flex gap-4 w-full flex-col lg:flex-row">
                <TextInput class="w-full lg:w-96" v-model:value="data.email" placeholder="email@wild-pitch.co.uk" type="email" :required="true" :errors="config.errors?.email"/>
                <CustomButton type="round" text="Sign Up" class="flex h-12 items-center justify-center w-full lg:w-48" :loading="config.submitting"/>
            </div>
            <div class="text-white text-xs">
                By clicking Sign Up you're confirming that you agree with our <router-link :to="{ name: 'privacy' }" class="link">Terms and Conditions.</router-link>
            </div>
        </form>
    </div>
</template>