<template>
        <div id="messages"
            class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch" v-chat-scroll>

            <!-- Show Messages -->
            <Message :position="msg.user.name === currentUser.name ? 'right' : 'left' " :user="msg.user" v-for="(msg, index) in messages" :key="index">
                <span :title="formatDate(msg.created_at)">{{ msg.content }}</span>
            </Message>

            <!-- Show Typing Indicator -->
            <div v-if="isTyping && name != null">
                <Message position="left" :user="{ name: name }">
                    <i>{{ name }} is typing...</i>
                </Message>
            </div>

        </div>
</template>

<script>
    import moment from 'moment';
    import Message from './Message.vue';
    export default {
        components: {
            Message
        },

        props: ['messages', 'isTyping', 'name', 'currentUser'],

        methods: {
            formatDate(dateTime) { return moment(dateTime).format('MMM D, YYYY, h:mm A'); }
        }
    }
</script>

<style scoped>
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
