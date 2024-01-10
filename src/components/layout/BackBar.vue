<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { useRouter } from 'vue-router';

const props = defineProps({
    backTo: {
        type: Object,
        required: true
    }
});

const router = useRouter();

</script>

<template>
    <div class="flex w-full items-start">
        <div class="w-12 h-12">
            <FontAwesomeIcon icon="fa-solid fa-arrow-left" size="lg" class="p-3 hover:p-4 rounded-full bg-gray-100 cursor-pointer transition-all ease-in-out flex justify-start items-start aspect-square"
            @click="() => router.push( backTo )"
            />
        </div>
    </div>
</template>