<template>
    <div class="w-full md:max-w-7xl md:mx-auto flex justify-between mb-4">
        <div></div>
        <BaseButton @click="router.push({name: 'User'})">List All User</BaseButton>
    </div>

    <BaseCard class="p-6">
        <UserForm></UserForm>
    </BaseCard>
</template>

<script>
export default {
    name: 'UserAction'
}
</script>

<script setup>
import { useRouter } from "vue-router";
import UserForm from "./Form";

const router = useRouter();
</script>
