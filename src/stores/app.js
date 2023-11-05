import { defineStore } from 'pinia';

export const useAppStore = defineStore('app', {
    state: () => ({
        messageStreamMessages: []
    }),
    getters: {
        messageStream: ( state ) => state.messageStreamMessages
    },
    actions: {
        async pushToMessageStream( message ) {
            this.messageStreamMessages.push(message)
        },
        async setMessageStream( messages ) {
            this.messageStreamMessages = messages;
        },
        async clearMessageStream() {
            this.messageStreamMessages = [];
        },
    },
});