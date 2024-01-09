<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import Logo from './Logo.vue';

</script>

<template>
    <footer class="bg-gray-800">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8 text-white">
            <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <router-link :to="{ name: 'home' }" >
                    <Logo :dark="true"/>
                </router-link>
            </div>
            <div class="grid grid-cols-3 gap-8 sm:gap-6 sm:grid-cols-3">
                <div>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase">Follow us</h2>
                    <ul class="font-medium">
                        <li class="mb-4">
                            <a href="https://www.instagram.com/wildpitch_camping/" target="_blank" class="hover:underline ">Instagram</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold uppercase">Other Stuff</h2>
                    <ul class="font-medium">
                        <li class="mb-4">
                            <router-link :to="{ name: 'privacy' }"  class="hover:underline">
                                Privacy Policy
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm sm:text-center">© 2023 <a href="/" class="hover:underline">WildPitch</a>. All Rights Reserved.
            </span>
            <div class="flex mt-4 space-x-5 sm:justify-center sm:mt-0">
                <a href="https://www.instagram.com/wildpitch_camping/" target="_blank" class="hover:text-gray-900">
                    <font-awesome-icon icon="fa-brands fa-instagram" size="xl" />
                    <span class="sr-only">Instagram</span>
                </a>
            </div>
        </div>
        </div>
    </footer>
</template>