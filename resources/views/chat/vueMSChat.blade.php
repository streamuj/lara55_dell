<div id="app">
    <li class="list-group-item active">MS chat <span class="badge badge-warning">@{{ numberOfUsers }}</span></li>
        <div class="badge badge-pill badge-primary">@{{ typing }}</div>

        <ul class="list-group" v-chat-scroll style="overflow-y: auto; max-height: 200px;">

            <message
                    v-for="value,index in chat.message"
                    :key = value.index
                    :color = chat.color[index]
                    :user = chat.user[index]
                    :time = chat.time[index]>
                @{{ value }}
            </message>
        </ul>
    <input type="text" class="form-control" v-model="message" @keyup.enter="send">


</div>

