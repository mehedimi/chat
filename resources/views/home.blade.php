@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Chat With Friends</div>
                <div class="panel-body" id="chat-body" style="height: 300px;overflow: auto; position: ">
                    <ul class="list-group">
<!--                         <li class="list-group-item" v-for="message in messages" ><b></b> : </li> -->
                        <div class="media" style="border:1px solid #ddd; padding: 10px" v-for="message in messages" :class="{'text-right' : isOwnMessage(message.user.id)}">
                            <div class="media-left" :class="{'pull-right' : isOwnMessage(message.user.id)}">
                                <a href="https://www.fb.com/mehedimi">
                                    <img class="media-object" :src="message.user.avater_url" alt="User Photo">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><b>@{{message.user.name}}</b> says <sub>@{{ message.created_at }}</sub></h4>
                                @{{ message.message }}
                            </div>
                        </div>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="form-group" >
                        <textarea name="message" v-on:keyup.enter="getKeyCode" v-model="message" class="form-control" placeholder="Write your message and hit Enter.. " id="message" rows="4"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>

        var app = new Vue({
            el : "#app",
            data : {
                messages : [],
                message : '',
                currentUser : {{ auth()->user()->id }}
            },
            methods : {
                getKeyCode : function(e){
                    if (!e.shiftKey) {
                        if (this.message == '') {
                            return;
                        }
                        $.ajax({
                            url : "{{ route('message.create') }}",
                            type : "post",
                            data : {
                                message : this.message,
                                _token : "{{ csrf_token() }}"
                            }
                        });
                        this.message = '';
                    }
                },
                isOwnMessage : function(userId){
                    return this.currentUser == userId;
                }
            },
            mounted : function(){
               axios.get('{{route('messages.all')}}').then(response => this.messages = response.data);
               scrollBottom();
            },



        });

        Pusher.logToConsole = true;

        var pusher = new Pusher('{{config("broadcasting.connections.pusher.key")}}', {
          encrypted: true
        });

        var channel = pusher.subscribe('chat');
        channel.bind('App\\Events\\ChatEvent', function(data) {
          app.messages.push(data.data);
          scrollBottom();
        });

        function scrollBottom(){
            $('#chat-body').animate({
                 scrollTop: $('#chat-body')[0].scrollHeight}, 300
            );
        }
    </script>
@endsection
