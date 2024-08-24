import './bootstrap';
import Echo from 'laravel-echo';
import { createApp } from 'vue';
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatForm.vue';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const token = document.querySelector('meta[name="csrf-token"]');
const csrfToken = token ? token.getAttribute('content') : '';

console.log(import.meta.env.VITE_PUSHER_APP_KEY)

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        }
    }
});



import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({
    data() {
        return {
            messages: []
        };
    },
    created() {
        this.fetchMessages();

        window.Echo.private('chat')
            .listen('MessageSent', (e) => {
                console.log("a")
                this.messages.push(e.message);
            });
    },
    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },
        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        }
    }
});

app.component('example-component', ExampleComponent);

app.component('chat-messages', ChatMessages);
app.component('chat-form', ChatForm);

app.mount('#app');
