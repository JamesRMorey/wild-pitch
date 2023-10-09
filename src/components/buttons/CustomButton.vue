<script setup>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';

const props = defineProps({
    pressHandler: {
        type: Function,
        required: false,
        default: () => {}
    },
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
</script>

<template>
        <button @click="pressHandler()" 
            :class="type == 'primary' ? 'bg-white py-2 px-8 rounded-full inline-flex justify-center items-center border-grey border-2' : ''" 
            v-bind="$attrs"
        >
            <PulseLoader v-if="loading" class="items-center inline-flex justify-center"/>
            <div v-else
                :class="type == 'primary' ? 'text-md text-dark-grey font-bold capitalize' : ''"
            >
                {{ text }}
            </div>
        </button>
</template>