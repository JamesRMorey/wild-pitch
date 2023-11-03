<script setup>
import { useRouter } from 'vue-router';
import Container from '../components/layout/Container.vue';

const router = useRouter();

</script>

<template>
    <div class="flex flex-col min-h-screen">
        <div class="flex flex-1">
            <Container>
                <div class="w-full flex-1 flex-col gap-5 py-10 px-5 items-center inline-flex justify-center">
                    <div class="inline-flex flex-col justify-center items-center gap-8 px-0 lg:px-16">
                        <img src="/logos/icon.webp" class="w-96" alt="wild pitch icon"/>
                        <div class="inline-flex flex-col gap-2">
                            <div class="text-2xl font-bold">This definitely isnt the pitch you're looking for...</div>
                            <div class="text-md">Let's get you back to civilisation shall we, its time to pack up and <router-link class="underline font-bold" :to="{ name: 'home' }">go home!</router-link></div>
                        </div>
                    </div>
                </div>
            </Container>
        </div>
    </div>
</template>
