<script setup>
import AccountLayout from '../../components/layout/account/AccountLayout.vue';
import { onMounted, ref } from 'vue';
import Api from '../../services/Api';
import TextInput from '../../components/inputs/TextInput.vue';

const api = new Api();

onMounted(() => {

})

const valuetest = ref('wdwd');


</script>

<template>
    <AccountLayout headerText="your account" subtitleText="manage, edit and remove your details">   
        <TextInput v-model:value="valuetest"/>
    </AccountLayout>
</template>