
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// require('./emoji_picker/config.js');
// require('./emoji_picker/util.js');
// require('./emoji_picker/jquery.emojiarea.js');
// require('./emoji_picker/emoji-picker.js');


window.Vue = require('vue');
//for autoscroll
import Vue from 'vue'
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

//for notification
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('message', require('./components/message.vue'));

const app = new Vue({
    el: '#app',

    data:{
        message:'',
        chat:{
            message:[],
            user:[],
            avatar:[],
            color:[],
            time:[]
        },
        typing:'',
        numberOfUsers:0

    },
    watch:{
        message(){
            Echo.private('chat')
                .whisper('typing', {
                    name: this.message
                });
        }
    },

    methods: {
        send(){
            if(this.message.length !=0){

                this.chat.message.push(this.message);
                this.chat.user.push('you');
                this.chat.color.push('success');
                this.chat.time.push(this.getTime());


                axios.post('/send', {
                    message: this.message,
                    chat: this.chat
                })
                    .then(response => {
                        // console.log(response);
                        this.message= '';

                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        getTime(){
            let time = new Date();
            return time.getHours()+':'+time.getMinutes()
        },

        getOldMessages(){
            axios.post('/check')
                .then(response => {
                    // console.log(response);
                    if(response.data != ''){
                        this.chat= response.data;

                    }

                })
                .catch(error => {
                    console.log(error);
                });
        }
    },

    mounted(){
        Echo.private('chat')
            .listen('ChatEvent', (e) => {
                this.chat.message.push(e.message);
                this.chat.user.push(e.user);
                this.chat.avatar.push(e.avatar);
                this.chat.time.push(this.getTime());
                this.chat.color.push('warning');

                // console.log(e);
            })
            .listenForWhisper('typing', (e) => {

                if(e.name !="") {
                    this.typing = 'typing...'
                }else{
                    this.typing = ''

                }
            });

            Echo.join(`chat`)
            .here((users) => {
                //
                this.numberOfUsers = users.length;
            })
            .joining((user) => {
                this.numberOfUsers += 1;
                this.$toaster.success(user.name+' is joined room.')

                // console.log(user.name);
            })
            .leaving((user) => {
                this.numberOfUsers -= 1;
                this.$toaster.warning(user.name+' left room.')

                // console.log(user.name);
            });
    }
});
