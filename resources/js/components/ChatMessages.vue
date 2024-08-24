<template>
    <div class="messages">
        <div v-for="message in messages" :key="message.id">
            {{ message.body }}
        </div>
    </div>
</template>

<script>
export default {
    props: ['messages'],
}
</script>
