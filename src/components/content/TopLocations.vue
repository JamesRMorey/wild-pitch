<script setup>

import { ref } from 'vue';

const emit = defineEmits([ 'locationClick' ])

const topLocations = ref([
    { id: 38196, label: 'llanberis' },
    { id: 34544, label: 'kinder scout' },
    { id: 18425, label: 'derbyshire dales' },
    { id: 57159, label: 'snowdonia national park' },
    { id: 8019, label: 'brecon beacons' },
    { id: 17981, label: 'dartmoor' },
    { id: 21990, label: 'exmoor' },
    { id: 35665, label: 'lake district' },
    { id: 46428, label: 'north york moors' },
    { id: 46563, label: 'northumberland' },
    { id: 48740, label: 'peak district' },
    { id: 48892, label: 'pembrokeshire coastal national park' },
    { id: 57437, label: 'south downs' },
    { id: 72136, label: 'yorkshire dales' },
]);

</script>

<template>
    <div class="px-0 lg:px-32">
        <div class="border-2 border-gray-200 rounded-3xl p-6 gap-2 justify-center inline-flex items-center flex-wrap">
            <div v-for="( location, i ) in topLocations"
                class="inline-flex m-1 rounded-full p-2 px-4 bg-gray-100 hover:bg-gray-200 cursor-pointer gap-2 justify-center items-center border"
                @click="emit('locationClick', location.id )"
                >
                <div class="capitalize">{{ location.label }}</div>
            </div>
        </div>
    </div>
</template>