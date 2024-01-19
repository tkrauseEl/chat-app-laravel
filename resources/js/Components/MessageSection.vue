<template>
  <div class="flex flex-col px-20">
    <div ref="messageContainer" class="h-96 bg-gray-800" style="max-height: 500px; overflow-y: auto;">
      <div v-for="message in messages" :key="message.id" class="m-10 flex items-start justify-between">
        <div>
          <div class="flex items-center">
            <p class="text-white pr-2 font-bold">{{ message.name }}</p>
            <p class="text-white text-xs">{{ new Date(message.created_at).toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' }) }}</p>
          </div>
          <p class="text-white">{{ message.message }}</p>
        </div>
        <button @click="deleteMessage(message.id)" class="text-red-400">Delete</button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import axios from 'axios';
import { onMounted, ref, watchEffect } from 'vue';

interface Message {
  id: number;
  name: string;
  user_id: number;
  message: string;
  created_at: string;
  updated_at: string;
}

const messages = ref<Message[]>([]);
const messageContainer = ref(null);

const fetchMessages = async () => {
  try {
    const response = await axios.get('/allMessages');
    messages.value = response.data;
  } catch (error) {
    console.error(error);
  }
};

const deleteMessage = async (messageId: number) => {
  try {
    await axios.delete(`/deleteMessage/${messageId}`);
    fetchMessages();
  } catch (error) {
    console.error(error);
  }
};

onMounted(() => {
  fetchMessages();
});

watchEffect(() => {
  const intervalId = setInterval(fetchMessages, 2000);
  return () => clearInterval(intervalId);
});

</script>
