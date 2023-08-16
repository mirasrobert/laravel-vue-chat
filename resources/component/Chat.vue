<template>

    <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen">
        <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200">
            <div class="relative flex items-center space-x-4">
                <div class="relative">
                    <span class="absolute text-green-500 right-0 bottom-0">
                        <svg width="20" height="20">
                            <circle cx="8" cy="8" r="8" fill="currentColor"></circle>
                        </svg>
                    </span>
                    <img v-if="user != null" :src="`https://ui-avatars.com/api/?name=${user.name}`" alt=""
                        class="w-10 sm:w-16 h-10 sm:h-16 rounded-full">
                </div>
                <div class="flex flex-col leading-tight">
                    <div class="text-2xl mt-1 flex items-center">
                        <span v-if="user != null" class="text-gray-700 mr-3">{{ user.name }}</span>
                    </div>
                    <span class="text-lg text-gray-600">Online</span>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button type="button"
                    class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <button type="button"
                    class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </button>
                <button type="button"
                    class="inline-flex items-center justify-center rounded-lg border h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <Messages :currentUser="user" :messages="messages" :isTyping="isTyping" :name="name" />

        <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
            <div class="relative flex">
                <span class="absolute inset-y-0 flex items-center">
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z">
                            </path>
                        </svg>
                    </button>
                </span>
                <input @keyup.enter="send" v-model="message" type="text" placeholder="Write your message!"
                    class="w-full focus:outline-none focus:placeholder-gray-400 text-gray-600 placeholder-gray-600 pl-12 bg-gray-200 rounded-md py-3">
                <div class="absolute right-0 items-center inset-y-0 hidden sm:flex">
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                            </path>
                        </svg>
                    </button>
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </button>
                    <button type="button"
                        @click="send"
                        class="inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
                        <span class="font-bold">Send</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="h-6 w-6 ml-2 transform rotate-90">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import Messages from './Messages.vue'
    export default {
        components: {
            Messages
        },

        props: ['chatRoomId'],

        data() {
            return {
                message: '',
                messages: [],
                user: null,
                isTyping: false,
                name: null
            }
        },
        methods: {

            send() {
                if (this.message.length > 0) {
                    console.log(this.message)

                    this.messages.push({
                        content: this.message, // MESSAGE CONTENT
                        position: 'right',
                        user: this.user
                    }) // myself

                    // Send AJAX on the /send route to fire ChatEvent
                    axios.post('/api/send', {
                            message: this.message,
                            chat_room_id: this.chatRoomId,

                        })
                        .then(response => {
                            console.log('send ajax to event')
                            this.message = ''; // Clear message input
                        })
                        .catch(e => console.error(e))



                }
            },


        },
        mounted() {

            // 1. Listen to channel `chat` of `ChatEvent` Class from Laravel.
            // -- Listen if ChatEvent is fired from /send route.
            Echo.private(`chat.room.${this.chatRoomId}`)
                .listen('ChatEvent', (e) => {

                    this.messages.push({
                        content: e.message,
                        position: 'left',
                        user: e.user
                    }) // broadcasted to other person

                    console.log('broadcasted')
                })
                .listenForWhisper('typing', (e) => {
                    // Listen and receive the fired whisper `typing`

                    // This will be broadcasted to other person that you are typing or not.

                    console.log('Other person is typing')

                    // If you typing, then this will be broadcasted to the other person's component that you are typing a message.
                    if(e.messageLength > 0) {
                        this.isTyping = true
                        this.name = e.name // This is your name that will sent to other person
                    } else {
                        this.isTyping = false // Is Not Typing
                        this.name = null
                    }

                });

            // 2. Get the current user
            axios.get('/api/user')
                .then(response => {
                    this.user = response.data
                })
                .catch(e => console.error(e));

            // 3. Load all messages
            axios.get(`/api/messages/${this.chatRoomId}`)
                .then(response => {
                    this.messages = response.data;
                })
                .catch(e => console.error(e));

        },
        watch: {
            message(newValue) {

                // If message value changes fire a whisper `typing`
                Echo.private(`chat.room.${this.chatRoomId}`)
                    .whisper('typing', {
                        name: this.user.name,
                        messageLength: newValue.length
                    });
            }
        }

    }
</script>

<style scoped>

</style>
