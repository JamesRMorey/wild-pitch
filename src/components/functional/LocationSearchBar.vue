<script setup>
import Api from '../../services/Api';
import { ref, watch } from 'vue';
import { debounce } from 'lodash';

const emit = defineEmits([ 'search' ]);

const props = defineProps({
    initialText: {
        type: String,
        required: false,
        default: ''
    }
});

const { initialText } = props

const api = new Api();

const locations = ref([]);
const showLocations = ref(false);
const text = ref(initialText);
const selectedLocation = ref({});
const searchDiv = ref();

const handleSearch = () => {
    emit('search', selectedLocation.value );
    showLocations.value = false;
}

const getLocations = () => {
    api.getLocations( text.value )
        .then(( response ) => updateLocations( response ))
        .catch(( error ) => console.log(error));
}

const debouncedGetLocations = debounce(getLocations, 300);

const updateLocations = ( result ) => {
    locations.value = result;
    showLocations.value = true;
}

const handleLocationClick = ( location ) => {
    text.value = location.name;
    selectedLocation.value = location;
    emit('search', selectedLocation.value );
    showLocations.value = false;
}

watch( text, () => {
    if ( text.value == '' ) {
        showLocations.value = false;
        return;
    }
    if (selectedLocation.value.name == text.value) return;
    selectedLocation.value = {};
    debouncedGetLocations();
});

const handleDocumentClick = ( event ) => {
    if ( searchDiv.value && !searchDiv.value.contains( event.target )) showLocations.value = false;
}

document.addEventListener('click', handleDocumentClick);

</script>

<template>
    <div class="inline-flex flex-col relative w-full">
        <div class="bg-gray-100 rounded-full px-5 py-4 md:py-2.5 inline-flex items-center gap-5 w-full" ref="searchDiv">
            <input class="grow shrink basis-0 w-full sm:w-96 md:w-96 lg:w-96 bg-transparent text-gray" placeholder="an awesome place called..." v-model="text" @click="showLocations = true"/>
            <button class="rounded-full bg-white items-center justify-center px-5 py-2.5 hover:bg-gray-200 hidden md:block" @click="handleSearch" >
                <div class="text-md">search</div>
            </button>
        </div>
        <div class="relative md:mt-2 inline-flex">
            <div v-if="showLocations == true && locations.length > 0" class="px-3 py-3 shadow bg-white absolute rounded-2xl w-full inline-flex flex-col gap-1">
                <div v-for="( location, i ) in locations" class="py-3 px-4 hover:bg-gray-100 rounded-xl cursor-pointer" @click="handleLocationClick( location )">
                    {{ location.name }} - {{ location.county }}
                </div>
            </div>
        </div>
    </div>
    
</template>