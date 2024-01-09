<script setup>
import { ref, toRefs } from 'vue';
import CustomButton from '../buttons/CustomButton.vue';


const props = defineProps({
    boxes: {
        type: Array,
        required: true,
    },
    image: {
        type: String,
        required: false
    },
});

const emit = defineEmits([ 'boxPress' ]);

const { image } = toRefs( props );

const activeImage = ref( 0 );

const changeImage = ( i ) => {
    activeImage.value = i;
}

</script>

<template>
    <div class="inline-flex">
        <div class="gap-10 inline-flex grid lg:grid-cols-2">
            <div class="flex relative">
                <img v-for="( box, i ) in boxes" :src="box.image" 
                    class="absolute top-0 right-0 left-0 aspect-square object-cover object-center rounded-2xl transition-all ease-in-out" 
                    :class="activeImage == i ? 'opacity-100' : 'opacity-0'"
                    loading="lazy"
                />
            </div>
            <div class="grid grid-cols-2 gap-8">
                <div v-for="( box, i ) in boxes" class="p-5 bg-gray-100 aspect-square rounded-2xl flex flex-col justify-center" 
                    @mouseenter="changeImage( i )"
                >
                    <div class="flex flex-1 flex-col justify-center items-start gap-1">
                        <div>
                            <font-awesome-icon :icon="'fa-solid ' + box.icon " size="lg" class="text-green-dark"/>
                            <div class="text-lg font-bold">{{ box.title }}</div>
                        </div>
                        <div>{{ box.text }}</div>
                    </div>
                    <div class="flex justify-end">
                        <CustomButton :text="box.buttonText" @press="emit( 'boxPress', i )"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>