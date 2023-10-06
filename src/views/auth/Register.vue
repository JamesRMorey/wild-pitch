<script setup>
import CustomButton from '../../components/buttons/CustomButton.vue';

    const images = [
        'https://snowdonia.gov.wales/wp-content/uploads/2022/01/NVW-C11-1516-0041.jpg',
        'https://i0.wp.com/www.mudandroutes.com/wp-content/uploads/2011/11/moel_11_179_960.jpg?w=1063&h=797&ssl=1',
        'https://uploads-ssl.webflow.com/5e9741806e8dc26f407c3536/60536c1863348825e58d9599_Wild%20Camping%20in%20Snowdonia%20Trip%20-%20Cover%20Image%20-%20Compressed.jpg',
        'https://skipandjump.co.uk/wp-content/uploads/2020/09/a7538-img_9987-edit.jpg',
        'https://www.theordinaryadventurer.com/wp-content/uploads/2016/09/P5290068.jpg',
        'https://www.theordinaryadventurer.com/wp-content/uploads/2016/09/P5290068.jpg'
    ]
    const background = images[Math.floor(Math.random() * (images.length - 0 + 1)) + 0];
</script>

<template>
    <div class="w-full h-screen grid grid-cols-2 gap-5 p-10">
        <div class="inline-flex flex-col h-full justify-center item-center gap-5 px-16">
            <div class="font-semibold text-3xl">Register</div>
            <div class="flex-col inline-flex gap-3">
                <div class="text-lg">Email</div>
                <input type="email" class="bg-gray-100 rounded-full py-3 px-5" placeholder="email"/>
            </div>
            <div class="flex-col inline-flex gap-3">
                <div class="text-lg">Password</div>
                <input type="password" class="bg-gray-100 rounded-full py-3 px-5" placeholder="password"/>
            </div>
            <div class="flex-col inline-flex gap-3">
                <div class="text-lg">Confirm Password</div>
                <input type="password" class="bg-gray-100 rounded-full py-3 px-5" placeholder="password"/>
            </div>
            <div class="inline-flex justify-end pt-5">
                <CustomButton text="register"/>
            </div>
            <div>
                <div>
                    already have an account? click <router-link class="underline" to="/login">here to login</router-link>
                </div>
            </div>
        </div>
        <div class="w-full h-full rounded-xl bg-center bg-cover text-right p-4" :style="{ backgroundImage: `url(${background})`}"></div>
    </div>
</template>