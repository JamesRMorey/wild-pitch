<script setup>
import PageLayout from '../PageLayout.vue';
import { toRefs } from 'vue';
import CustomButton from '../../buttons/CustomButton.vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import PageHeader from '../PageHeader.vue';
import PageFooter from '../PageFooter.vue';
import Container from '../Container.vue';
import BannerSlim from '../../banners/BannerSlim.vue';

const props = defineProps({
    headerText: {
        type: String,
        required: false
    },
    subtitleText: {
        type: String,
        required: false
    },
    buttons: {
        type: Array,
        required: false,
        default: []
    },
    loading: {
        type: Boolean,
        required: false,
        default: false
    }
});

const { buttons } = toRefs( props );

</script>

<template>
    <div class="min-h-screen flex flex-col">
        <PageHeader />
            <Container>
                <div class="inline-flex py-8 justify-between items-center">
                    <div class="flex-col inline-flex">
                        <div v-if="headerText" class="text-3xl inline-flex capitalize">{{ headerText }}</div>
                        <div v-if="subtitleText" class="inline-flex">{{ subtitleText }}</div>
                    </div>
                    <div v-if="buttons.length" class="inline-flex gap-4 items-center">
                        <CustomButton v-for="(button, i) in buttons" @press="button['click']()"  :text="button.text" />
                    </div>
                </div>
                <div v-if="loading" class="justify-center items-center inline-flex">
                    <PulseLoader color="#000000"/>
                </div>
                <slot v-else></slot>
            </Container>
            <div class="flex-1 flex-col"></div>
        <PageFooter />
    </div>
</template>