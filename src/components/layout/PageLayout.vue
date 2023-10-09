<script setup>
import Container from './Container.vue';
import PageFooter from './PageFooter.vue';
import PageHeader from './PageHeader.vue';

</script>

<template>
    <div class="min-h-screen flex flex-col">
        <PageHeader />
        <Container>
                <slot></slot>
        </Container>
        <div class="flex-1 flex-col"></div>
        <PageFooter />
    </div>
</template>