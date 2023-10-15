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
            :class="type == 'primary' ? 'font-semibold py-2 px-6 bg-gray-100 hover:bg-gray-200 cursor-pointer rounded-xl' : ''" 
            v-bind="$attrs"
        >
            <div
                class="justify-center inline-flex items-center gap-3"
                :class="type == 'primary' ? 'text-md font-semibold' : ''"
            >
                {{ text }} <PulseLoader v-if="loading" color="#000000" size="10px"/>
            </div>
        </button>
</template>