<script setup>

const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    image: {
        type: String,
        required: true
    },
    title: {
        type: String,
        required: false
    },
    inverted: {
        type: Boolean,
        required: false,
        default: false
    }
});

</script>

<template>
    <div class="px-0 lg:px-32 inline-flex">
        <div class="bg-gray-100 rounded-xl gap-6 sm:gap-0 lg:gap-10 inline-flex grid lg:grid-cols-2 items-center p-8">
            <div class="inline-flex justify-center items-center" :class="inverted ? 'lg:order-last' : ''">
                <img
                    :src="image" 
                    class="h-auto sm:h-64 lg:h-auto aspect-video object-cover object-center lg:aspect-square w-full bg-cover bg-center rounded-xl shadow block sm:hidden lg:block"
                    loading="lazy"
                />
            </div>
            <div class="inline-flex flex-col gap-2 lg:gap-5">
                <h2 v-if="title" class="text-5xl font-semibold">{{ title }}</h2>
                <div v-html="text"></div>
            </div>
        </div>
    </div>
</template>