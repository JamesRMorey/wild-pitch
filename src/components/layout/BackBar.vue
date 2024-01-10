<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { toRefs } from 'vue';
import { useRouter } from 'vue-router';

const props = defineProps({
    backTo: {
        type: Object,
        required: false
    }
});

const router = useRouter();

const { backTo } = toRefs( props );

const navigate = () => {
    if ( backTo?.value ) {
        router.push( backTo.value )
    } else {
        router.go(-1);
    }
}

</script>

<template>
    <div class="flex w-full items-start">
        <div class="w-12 h-12">
            <FontAwesomeIcon icon="fa-solid fa-arrow-left" size="lg" class="p-3 hover:p-4 rounded-full bg-gray-100 cursor-pointer transition-all ease-in-out flex justify-start items-start aspect-square"
            @click="navigate"
            />
        </div>
    </div>
</template>