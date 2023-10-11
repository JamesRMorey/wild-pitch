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
            <PulseLoader v-if="loading" class="items-center inline-flex justify-center"/>
            <div v-else
                :class="type == 'primary' ? 'text-md font-semibold' : ''"
            >
                {{ text }}
            </div>
        </button>
</template>