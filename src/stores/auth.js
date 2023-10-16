import { defineStore } from 'pinia';
import Api from '../services/Api';

const api = new Api();

export const useAuthStore = defineStore('auth', {
    state: () => ({
        authUser: null
    }),
    getters: {
        user: ( state ) => state.authUser
    },
    actions: {
        async getUser() {
            await api.getUser()
                .then(( user ) => {
                    this.authUser =  user ;
                })
                .catch( async ( error ) => {
                    this.authUser = null;
                    await api.logout();
                })
        },
        async setUser( user ) {
            this.authUser = user;
        },
        async clearUser() {
            this.authUser = null;
        }
    },
});