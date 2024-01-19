<template>
  <div class="flex items-center justify-between px-20">
    <input v-model="message" class="h-10 px-4 w-4/5" @keydown.enter="submitEnter">
    <button @click="submit" class="bg-blue-500 text-white px-4 py-2 w-1/5">Send Message</button>
  </div>
</template>

<script setup lang="ts">
import axios from 'axios';
import { ref } from 'vue';

const message = ref('');

const submit = async () => {
  try {
    const response = await axios.post("/messages", { message: message.value });
    message.value = '';
  } catch (err) {
    console.error(err);
  }
};

const submitEnter = (event: KeyboardEvent) => {
  if (event.key === 'Enter') {
    submit();
  }
};
</script>
