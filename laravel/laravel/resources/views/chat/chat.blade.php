@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default chat-panel" style="">
                <div class="panel-heading">Здесь будет чат</div>
                <ul style="" id="chat-panel-messages">
                    @foreach($messages as $message)
                        <li>
                            <div class="col-md-2">{{ $message['user']['name'] }}</div>
                            <div class="col-md-10">{{ $message['text'] }}<hr></div>
                        </li>
                    @endforeach
                </ul>

                <form action="{{ route('addMessage') }}" method="post" id="messageSend">
                    {{ csrf_field() }}
                    <input type="hidden" >
                    <textarea name="message" style="width: 100%" id=""  rows="5"></textarea><br>
                    <input type="submit">
                </form>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>



<div class="panel-users">
    <div class="panel-users-title">Пользователи</div>
    <ol class="users-list">
        @foreach($users as $user)
            <li>{{ $user['name'] }}</li>
        @endforeach
    </ol>
</div>

@endsection
