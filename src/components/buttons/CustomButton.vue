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
            class="transition-all ease-in-out cursor-pointer text-sm px-6 lg:px-8 py-2 lg:py-2.5 font-medium"
            :class="type == 'primary' ? 'bg-green block text-white hover:bg-green-dark rounded-lg' : '',
                    type == 'round' ? 'rounded-full bg-green text-white hover:bg-green-dark' : ''
                   " 
            v-bind="$attrs"
        >
            <div
                class="justify-center inline-flex items-center gap-3"
                :class="type == 'primary' ? 'text-md font-semibold' : '',
                        type == 'round' ? 'text-md font-semibold' : ''
                       "
            >
                {{ text }} <PulseLoader v-if="loading" color="#ffffff" size="10px"/>
            </div>
        </button>
</template>