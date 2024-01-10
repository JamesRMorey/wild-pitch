<script setup>
import HeaderWithText from './headers/HeaderWithText.vue';


const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: false
    },
    boxes: {
        type: Array,
        required: true
    }
});

</script>

<template>
    <div class="px-0 md:px-8 xl:px-0 inline-flex w-full gap-8 flex-col text-center md:text-left">
        <HeaderWithText :title="title" :text="text" />
        <div v-if="boxes.length > 0" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 xl:grid-cols-7 justify-start items-start w-full gap-5">
            <div v-for="( box, i ) in boxes" class="inline-flex w-full items-center flex-col gap-2 group" :class="i > 5 ? 'hidden xl:inline-flex' : ''">
                <router-link :to="{ name: box.link }"  
                    class="rounded-xl bg-gray-100 inline-flex justify-center items-center w-full aspect-[5/4] transition-all ease-in-out"
                    :class="box.link ? 'cursor-pointer group-hover:bg-green' : ''"
                >
                    <font-awesome-icon :icon="'fa-solid ' + box.icon " size="lg" class="text-green" :class="box.link ? 'group-hover:text-white' : ''"/>
                </router-link>
                <div v-text="box.text"></div>
            </div>
        </div>
    </div>
</template>
