<script setup>
import { useAppStore } from '../../stores/app'
import { ref, watch, computed } from 'vue';
import Message from './Message.vue';

const appStore = useAppStore();

const messages = computed(() => appStore.messageStream);
const visible = ref(false);

const removeMessage = ( i ) => {
    const newMessageStream = [...appStore.messageStream];
    newMessageStream.splice(i, 1);
    appStore.setMessageStream(newMessageStream); 
}

</script>

<template>
    <div class="fixed top-5 right-5 z-[1000] w-64 lg:w-96 gap-5 inline-flex flex-col">
        <Message v-for="( message, i ) in appStore.messageStream" :message="message" @remove="() => removeMessage( i )"/>
    </div>
</template>