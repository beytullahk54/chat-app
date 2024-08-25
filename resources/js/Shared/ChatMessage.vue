<template>
    <div>
        
        <header class="bg-white p-4 text-gray-700">
            <h1 class="text-2xl font-semibold">
                {{ props.id }} Nolu Oda</h1>
        </header>
        <div id="messages"  class=" pl-5 pr-5 flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch" v-if="messages.length>0">
            <div v-for="message in messages" :key="message.id" class="chat-message">
                <div class="flex items-end">
                    <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                        <div><span class="px-4 py-2 rounded-lg inline-block bg-gray-300 text-gray-600">{{ message.user_id }}: {{ message.body }} </span></div>
                    </div>
                    <img width="24" height="24" src="https://img.icons8.com/external-those-icons-fill-those-icons/24/external-Chat-user-actions-those-icons-fill-those-icons.png" alt="external-Chat-user-actions-those-icons-fill-those-icons"/>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({ messages:Object,id: String });
</script>

<style>
.scrollbar-w-2::-webkit-scrollbar {
    width: 0.25rem;
    height: 0.25rem;
  }
  
  .scrollbar-track-blue-lighter::-webkit-scrollbar-track {
    --bg-opacity: 1;
    background-color: #f7fafc;
    background-color: rgba(247, 250, 252, var(--bg-opacity));
  }
  
  .scrollbar-thumb-blue::-webkit-scrollbar-thumb {
    --bg-opacity: 1;
    background-color: #edf2f7;
    background-color: rgba(237, 242, 247, var(--bg-opacity));
  }
  
  .scrollbar-thumb-rounded::-webkit-scrollbar-thumb {
    border-radius: 0.25rem;
  }
</style>