<script setup>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';

const emit = defineEmits([ 'press' ]);

const props = defineProps({
    text: {
        type: String,
        required: true
    },
    type: {
        type: String,
        required: false,
        default: 'primary'
    },
    loading: {
        type: Boolean,
        required: false,
        default: false
    }
})

const handleClick = () => {
    emit('press');
}

</script>

<template>
        <button @click="handleClick" 
            class="w-full p-6 lg:px-12 py-4 rounded-xl font-bold capitalize transition-all ease-in-out"
            :class="type == 'primary' ? 'bg-green text-white hover:bg-green-dark ' : '', type == 'secondary' ? 'bg-gray-100 text-black hover:bg-gray-400 hover:text-white' : ''" 
            v-bind="$attrs"
        >
            <div
                class="justify-center inline-flex items-center gap-3"
            >
                {{ text }} <PulseLoader v-if="loading" color="#ffffff" size="10px"/>
            </div>
        </button>
</template>