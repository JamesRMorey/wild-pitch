<script setup>
    const props = defineProps({
        text: {
            type: String,
            required: false,
            default: "We've got no results! If you know somewhere around here why not add it?"
        }
    })

    const images = [
        'https://cdn.discordapp.com/attachments/905936824344645675/1158529758389346384/jimmo_a_wild_camping_illustration_in_a_circle_badge_5500c2d2-2896-4b1e-8000-177b224192a9.png?ex=651c946a&is=651b42ea&hm=cdc78a9071c4420d9bda6a6ce66494e6f297e2e9faeefcc73b044d88d82e9ff7&',
        'https://cdn.discordapp.com/attachments/905936824344645675/1158532538155937862/jimmo_a_wild_camping_illustration_in_a_circle_badge_a6f3bab4-e4e0-4e0e-83cb-560a893f1dd7.png?ex=651c9701&is=651b4581&hm=e62cd0b720767556f5daf9f35fd74a87161fa40fd9d4011176248ee33937e503&'
    ];

    const image = images[Math.floor(Math.random() * (images.length + 1))];
</script>

<template>
    <div class="flex-col inline-flex justify-center items-center text-center p-6">
        <div class="bg-cover aspect-square bg-no-repeat h-96" :style="{ backgroundImage: `url(${image})`}"></div>
        <div class="text-lg">{{ text }}</div>
    </div>
</template>