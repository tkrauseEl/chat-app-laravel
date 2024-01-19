<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import MessageSection from '../Components/MessageSection.vue';
import SendMessageButton from '../Components/SendMessageButton.vue';

</script>

<template>
    <Head title="Chatboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">CHATROOM 1</h2>
        </template>
        <MessageSection />
        <SendMessageButton />

    </AuthenticatedLayout>
</template>


  