<script setup>


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
    }
});

const emit = defineEmits([ 'next', 'prev', 'bulletPress' ]);

</script>

<template>
    <div class="flex justify-between items-start">
        <div class="flex justify-start gap-2 items-center">
            <div v-for="i in numSlides" 
                class="p-2 bg-gray-200 rounded-full transition-all ease-in-out" 
                :class="active == i ? 'bg-green-dark' : 'cursor-pointer hover:bg-green'"
                @click="() => emit( 'bulletPress', i )"
            ></div>
        </div>
        <div class="flex gap-2 items-center justify-center">
            <button class="hover:bg-green-dark flex items-center justify-center bg-green p-4 rounded-full aspect-square cursor-pointer w-12 transition-all ease-in-out" 
                @click="emit( 'prev' )"
            >
                <font-awesome-icon icon="fa-solid fa-chevron-left" class="text-white" />
            </button>
            <button class="hover:bg-green-dark flex items-center justify-center bg-green p-4 rounded-full aspect-square cursor-pointer w-12 transition-all ease-in-out" 
                @click="emit( 'next' )"
            >
                <font-awesome-icon icon="fa-solid fa-chevron-right"  class="text-white"/>
            </button>
        </div>
    </div>
</template>