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
                        <h1 class="page-header">My Inbox</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4><i class="fa fa-comment fa-fw"></i> Chat</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-lg-offset-3">
                                    <div class="chat-panel panel panel-default" id="chat">
                                        <div class="panel-heading">
                                            <i class="fa fa-comments-o fa-fw"></i>
                                            Messages
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <ul class="chat">
                                                @foreach($users->where(['deleted' => 0, 'confirmed' => 1])->get() as $user)
                                                    @if($user->role == 4)
                                                        @if($user->id != auth('admin')->user()->id)
                                                            <a href="{{ route('adminChat', encrypt($user->id))}}">
                                                                <li>
                                                                    {{ $user->name }}
                                                                </li>
                                                            </a>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- /.panel-body -->
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