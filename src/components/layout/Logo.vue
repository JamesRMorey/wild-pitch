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
    <div class="whitespace-nowrap self-center inline-flex gap-3 items-center" :class="dark ? 'dark:hidden dark:w-1 dark:h-1' : 'light:hidden light:w-1 light:h-1'">
        <img :src="dark ? '/logos/icon-white.webp' : '/logos/icon.webp'" class="h-10" alt="wild pitch logo"/>
        <img :src="dark ? '/logos/text-white.webp' : '/logos/text.webp'" class="h-7" alt="wild pitch text"/>
    </div>
</template>