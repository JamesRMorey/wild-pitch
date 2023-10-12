<script setup>
    const props = defineProps({
        dark: {
            type: Boolean,
            required: false,
            default: false
        }
    })
</script>

<template>
    <div class="whitespace-nowrap self-center inline-flex gap-3 items-center">
        <img :src="dark ? '/logos/icon-white.png' : '/logos/icon.png'" class="h-10"/>
        <img :src="dark ? '/logos/text-white.png' : '/logos/text.png'" class="h-7"/>
    </div>
</template>