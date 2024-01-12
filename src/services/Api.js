import axios from "axios";



export default class Api {
    constructor() {
        axios.defaults.withCredentials = true;
        axios.defaults.baseURL = import.meta.env.VITE_API_URL;
    }

    async getCSRF() {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'sanctum/csrf-cookie' )
            .then(( response ) => {
                const csrfToken = document.cookie
                .split('; ')
                .find((cookie) => cookie.startsWith('XSRF-TOKEN='))
                .split('=')[1];
                
                axios.defaults.headers.common['X-XSRF-TOKEN'] = csrfToken;

                resolve(csrfToken);
            }) 
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async login( email, password ) {
        return new Promise(async ( resolve, reject ) => {
            await this.getCSRF();
            await axios.post( 'login', { email: email, password: password } )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error.response.data );
            })
        })
    }

    async register( name, email, password, confirmPassword ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'sanctum/csrf-cookie' )
            await axios.post( 'register', { name: name, email: email, password: password, password_confirmation: confirmPassword } )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error.response.data );
            })
        })
    }

    async forgotPassword( email ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'sanctum/csrf-cookie' )
            await axios.post( 'forgot-password', { email: email } )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error.response.data );
            })
        })
    }

    async resetPassword( email, password, confirmPassword, token ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'sanctum/csrf-cookie' )
            await axios.post( 'reset-password', { token: token, email: email, password: password, password_confirmation: confirmPassword } )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error.response.data );
            })
        })
    }

    async logout() {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'sanctum/csrf-cookie' )
            await axios.post( 'logout' )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async getUser() {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/user' )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error.response.data );
            })
        })
    }

    async updateUser( data ) {
        return new Promise(async ( resolve, reject ) => {
            await this.getCSRF();
            await axios.put( 'api/user', data )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error.response.data );
            })
        })
    }

    async deleteUser() {
        return new Promise(async ( resolve, reject ) => {
            await this.getCSRF();
            await axios.delete( 'api/user' )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error.response.data );
            })
        })
    }

    async getLocations( searchTerm='a' ) {
        return new Promise(async ( resolve, reject ) => {
            await this.getCSRF();
            await axios.post( 'api/search/locations', { search_term: searchTerm } )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async getPitchesForLocation( locationId, page=1, filters={} ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/locations/' + locationId + '/pitches', { params: { page: page, filters: filters }} )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async getPitch( id ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/pitches/' + id )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async getUserPitches() {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/user/pitches' )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async createPitch( data ) {
        return new Promise(async ( resolve, reject ) => {
            await this.getCSRF();
            await axios.post( 'api/pitches/store',  data, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            } )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error.response.data );
            })
        })
    }

    async deletePitch( id ) {
        return new Promise(async ( resolve, reject ) => {
            await this.getCSRF();
            await axios.delete( 'api/pitches/destroy/' + id )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async getFeatures( ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/features' )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async savePitch( id ) {
        return new Promise(async ( resolve, reject ) => {
            await this.getCSRF();
            await axios.post( 'api/pitch/' + id + '/save')
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async unSavePitch( id ) {
        return new Promise(async ( resolve, reject ) => {
            await this.getCSRF();
            await axios.post( 'api/pitch/' + id + '/un-save')
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async getSavedPitches(  ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/user/saved-pitches')
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async getLocation( id ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/locations/' + id )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async getFavouritePitches() {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/content/favourite-pitches' )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async signUpNewsletter( email ) {
        return new Promise(async ( resolve, reject ) => {
            await this.getCSRF();
            await axios.post( 'api/newsletter/sign-up', {
                email: email
            })
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async getPitchesInArea( pitchId ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/pitches/' + pitchId + '/others-in-area' )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async getUserProfile( userId ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/profile/user/' + userId  )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }
}