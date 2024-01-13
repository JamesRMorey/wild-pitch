<script setup>

</script>

<template>
    <div class="w-full inline-flex flex-col gap-3 justify-center bg-center bg-cover group">
        <div class="w-full rounded-xl bg-center bg-cover aspect-square text-right relative">
            <div class="bg-gray-100 w-full rounded-xl aspect-square"></div>
        </div>
        
        <div class="flex flex-col justify-between items-between gap-5">
            <div class="inline-flex flex-col">
                <div class="text-lg bg-gray-100 text-transparent rounded-t-xl">title</div>
                <div class="bg-gray-100 text-transparent rounded-b-xl">description</div>
            </div>
            <div class="flex justify-between items-end">
                <div class="flex gap-2 items-end px-2 truncate ... p-2 bg-gray-100 rounded-xl">
                    <div v-for="i in 4">
                        <font-awesome-icon icon="fa-solid fa-tent" class="text-transparent"/>
                    </div>
                </div>
                <div class="px-5 py-1 rounded-xl text-right font-semibold text-transparent bg-gray-100 h-full">
                    view
                </div>
            </div>
        </div>
    </div>
</template>