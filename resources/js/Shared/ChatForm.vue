<template>
    <div class="chat-form">
        <input v-model="newMessage" @keyup.enter="sendMessage">
    </div>
</template>

<script>
export default {
    data() {
        return {
            newMessage: ''
        }
    },
    methods: {
        sendMessage() {
            this.$emit('send', { body: this.newMessage });
            this.newMessage = '';
        }
    }
}
</script>
