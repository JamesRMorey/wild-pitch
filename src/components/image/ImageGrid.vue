<script setup>
import { toRefs, ref } from 'vue';

const showMore = ref(false)

const props = defineProps({
    images: {
        type: Array,
        required: true,
    },
});

const { images } = toRefs( props );

const thumbnail = images.value[0];
const otherImages = images.value.slice(1, 5);

</script>

<template>
    <div class="w-full inline-flex flex-col md:grid md:grid-cols-2 gap-3">
        <img :src="thumbnail" loading="lazy" class="w-full rounded-xl overflow-hidden object-center object-cover aspect-square text-right" />
        <div v-if="!showMore" class="underline text-right block md:hidden cursor-pointer" @click="showMore = true">view more images</div>
        <div class="hidden md:grid grid-cols-2 gap-3">
            <img v-for="(image, i) in otherImages" :src="image" loading="lazy" class="w-full rounded-xl bg-center bg-cover aspect-square relative" />
        </div>
        <div class="grid-cols-2 gap-3 md:hidden" :class="[ showMore ? 'grid' : 'hidden' ]">
            <div v-for="(image, i) in otherImages" class="w-full rounded-xl bg-center bg-cover aspect-square relative p-4" :style="{ backgroundImage: `url(${image})`}">
                <div v-if="images.length > 5 && i == 3" class="absolute bottom-0">
                    show more
                </div>
            </div>
        </div>
        <div v-if="showMore" class="underline text-right block md:hidden cursor-pointer md:hidden" @click="showMore = false">hide images</div>
    </div>
</template>