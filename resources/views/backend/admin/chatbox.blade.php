@extends('templates.master')

@section('content')

    <div id="wrapper">

        <!-- Navigation -->
        @include('backend.admin.templates.nav')
                <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chat</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4><i class="fa fa-comments-o fa-fw"></i> Messages</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                    <div class="chat-panel panel panel-default" id="chat">
                                        <div class="panel-heading">
                                            <i class="fa fa-user fa-fw"></i>
                                            {{ $users->where(['id' => $id])->first()->name }}
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <ul class="chat list-unstyled">
                                                @if($chat->count() != 0)
                                                    @foreach($chat as $msg)
                                                        <li>
                                                            @if($msg->sender != auth('admin')->user()->id)
                                                                <div class="text-left">
                                                                    <span class="text-primary"><b>{{ $users->where('id', $msg->sender)->first()->name }}</b></span><br>
                                                                    <span>{{ $msg->message }}</span><br>
                                                                    <span class="small text-muted">{{ $msg->created_at->format('M d') }} at {{ $msg->created_at->format('h:i a') }} </span>
                                                                </div>
                                                            @else
                                                                <div class="text-right">
                                                                    <span class="text-primary"><b>{{ $users->where('id', $msg->sender)->first()->name }}</b></span><br>
                                                                    <span>{{ $msg->message }}</span><br>
                                                                    <span class="small text-muted">{{ $msg->created_at->format('M d') }} at {{ $msg->created_at->format('h:i a') }} </span>
                                                                </div>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li>
                                                        <div class="text-center text-muted">Send a message to say hello!</div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <!-- /.panel-body -->
                                        <div class="panel-footer">
                                                {{ Form::open(['method' => 'post', 'url' => route('adminMessageSend', [encrypt($id), $chat_id])]) }}
                                                <div class="input-group">
                                                    {{ Form::text('message', null, ['id' => 'btn-input', 'class' => 'form-control input-sm', 'rows' => '1']) }}
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-primary btn-sm" id="btn-chat">
                                                            Send
                                                        </button>
                                                    </span>
                                                </div>
                                                {{ Form::close() }}
                                        </div>
                                    </div>
                                    <!-- /.panel .chat-panel -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop