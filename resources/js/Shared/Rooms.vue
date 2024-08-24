<template>
    <div>
        <h1 class="mb-8 text-3xl font-bold">Odalar</h1>
        <a @click="addRoom()">Oda Oluştur</a><br><br>
        <ul>
            <li v-for="i in rooms">    
                <Link class="mt-1 " :href="'/room/'+i.id">Oda {{i.id}}</Link>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { onMounted, ref } from 'vue';
import axios from 'axios';

const rooms = ref(5);

const fetchRooms = async () => {
  try {
    const response = await axios.get('/getRooms');
    rooms.value = response.data;
  } catch (error) {
    console.error('Error fetching messages:', error);
  }
};

const addRoom = async (message) => {
  try {
    const response = await axios.post(`/addRoom`, message);

    rooms.value.push(response.data); // Optimistically adding the message to the list
    //messages.value.push(message); // Optimistically adding the message to the list
    console.log('Message sent:', response.data);
  } catch (error) {
    console.error('Error posting message:', error);
  }
};


onMounted(async () => {
    fetchRooms()
})

</script>