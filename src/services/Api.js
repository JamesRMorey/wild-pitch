import axios from "axios";

axios.defaults.withCredentials = true;
axios.defaults.baseURL = 'http://localhost:8000/';

export default class Api {
    constructor() {}

    async getCSRF() {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'sanctum/csrf-cookie' )
            .then(( response ) => {
                resolve();
            }) 
            .catch(( error ) => {
                reject( error );
            })
        })
    }
    
    async login( email, password ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'sanctum/csrf-cookie' )
            await axios.post( 'login', { email: email, password: password } )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
            })
        })
    }

    async register( name, email, password, confirmPassword ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'sanctum/csrf-cookie' )
            await axios.post( 'login', { name: name, email: email, password: password, confirm_password: confirmPassword } )
            .then(( response ) => {
                resolve( response.data );
            })
            .catch(( error ) => {
                reject( error );
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
                reject( error );
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

    async getPitchesForLocation( locationId, page=1 ) {
        return new Promise(async ( resolve, reject ) => {
            await axios.get( 'api/location/' + locationId + '/pitches?page=' + page )
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
                reject( error );
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
}