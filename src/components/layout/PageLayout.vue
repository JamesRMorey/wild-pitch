<script setup>
import Container from './Container.vue';
import PageFooter from './PageFooter.vue';
import PageHeader from './PageHeader.vue';

</script>

<template>
    <PageHeader />
    <Container>
            <slot></slot>
    </Container>
    <PageFooter />
</template>