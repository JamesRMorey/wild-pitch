<script setup>

const emit = defineEmits([ 'press' ]);

const props = defineProps({
    icon: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        required: false,
        default: false
    }
})

</script>

<template>
        <font-awesome-icon :icon="'fa-solid ' + icon" @click="emit('press')" class="p-4 transition-all ease-in-out  rounded-full bg-gray-100 hover:bg-gray-200 cursor-pointer" :class="active ? 'bg-gray-200' : 'bg-gray-100'"/>
</template>