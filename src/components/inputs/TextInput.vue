<script setup>
import ErrorText from '../functional/ErrorText.vue';
import { toRefs, ref } from 'vue';

const emit = defineEmits([ 'clear', 'update:value' ])

const props = defineProps({
    label: {
        type: String,
        required: false,
        default: ''
    },
    errors: {
        type: Array,
        required: false,
        default: []
    },
    type: {
        type: String,
        required: false,
        default: 'text'
    },
    value: {
        type: String,
        required: true,
    },
    hideErrorText: {
        type: Boolean,
        required: false,
        default: false
    }
});

const { value } = toRefs(props);

const val = ref(value.value);

</script>

<template>
    <div class="flex-col inline-flex gap-3">
        <div v-if="label.length" class="text-lg">{{ label }}</div>
        <input @click="emit('clear')" @input="emit('update:value', val)" :type="type" class="bg-gray-100 rounded-full py-3 px-5" :class="errors?.length ? 'border-2 border-red-400' : ''" :placeholder="label.toLowerCase()" v-model="val" />
        <ErrorText v-if="errors?.length && !hideErrorText" :text="errors[0]" />
    </div>
</template>