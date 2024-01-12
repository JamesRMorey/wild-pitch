<script setup>
import { toRefs, computed } from 'vue';

const props = defineProps({
    numSlides: {
        type: Number,
        required: true
    },
    perPage: {
        type: Number,
        required: true,
        default: 3
    },
    active: {
        type: Number,
        required: true
    },
    showArrows: {
        type: Boolean,
        required: false,
        default: true
    }
});

const emit = defineEmits([ 'next', 'prev', 'bulletPress' ]);

const { numSlides, perPage, active } = toRefs( props )

const numDots = computed(() => {
    return Math.abs( numSlides.value - perPage.value + 1 );
});

const nextDisabled = computed(() => {
    return active.value == numSlides.value - perPage.value;
});

const prevDisabled = computed(() => {
    return active.value == 0;
})

</script>

<template>
    <div class="flex justify-between items-start">
        <div class="flex justify-start gap-2 items-center h-5">
            <div v-for="i in numDots" 
                class="p-2 bg-gray-200 rounded-full transition-all ease-in-out" 
                :class="active == i-1 ? 'bg-green-dark p-2.5' : 'cursor-pointer hover:bg-green'"
                @click="() => emit( 'bulletPress', i-1 )"
            ></div>
        </div>
        <div class="gap-2 items-center justify-center hidden" 
            :class="!showArrows ? 'hidden' : 'sm:flex'"
            >
            <button class="flex items-center justify-center bg-green p-4 rounded-full aspect-square w-12 transition-all ease-in-out" 
                :class="prevDisabled ? 'bg-opacity-50 cursor-default' : 'hover:bg-green-dark cursor-pointer'"
                @click="() => !prevDisabled ? emit( 'prev' ) : null"
            >
                <font-awesome-icon icon="fa-solid fa-chevron-left" class="text-white" />
            </button>
            <button class="flex items-center justify-center bg-green p-4 rounded-full aspect-square w-12 transition-all ease-in-out" 
                :class="nextDisabled ? 'bg-opacity-50 cursor-default' : 'hover:bg-green-dark cursor-pointer'"
                @click="() => !nextDisabled ? emit( 'next' ) : null"
            >
                <font-awesome-icon icon="fa-solid fa-chevron-right"  class="text-white"/>
            </button>
        </div>
    </div>
</template>