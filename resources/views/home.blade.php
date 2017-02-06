@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Chat With Friends</div>
                <div class="panel-body" id="chat-body" style="height: 200px;overflow: auto; position: ">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="message in messages" ><b>@{{message.user.name}}</b> : @{{ message.message }}</li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="form-group" >
                        <textarea name="message" v-on:keyup.enter="getKeyCode" v-model="message" class="form-control" placeholder="Write your message and hit Enter.. " id="message" rows="6"></textarea>
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
                message : ''
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
                }
            },
            mounted : function(){
               axios.get('{{route('messages.all')}}').then(response => this.messages = response.data);
               scrollBottom();
            },

        });

        Pusher.logToConsole = true;

        var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
          encrypted: true
        });

        var channel = pusher.subscribe('chat');
        channel.bind('App\\Events\\ChatEvent', function(data) {
          app.messages.push(data.data);
          scrollBottom();
        });

        function scrollBottom(){
            $('#chat-body').animate({
                 scrollTop: $('#chat-body')[0].scrollHeight}, 2000
            );
        }
    </script>
@endsection
