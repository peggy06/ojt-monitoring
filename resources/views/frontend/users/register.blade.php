@extends('templates.master')

@section('content')
    <div class="container">
        @include('frontend.users.templates.nav')
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        {{--31708f--}}
                        <h3 class="panel-title" style="color: #fff">Sign Up
                            <span class="pull-right">
                                <a href="{{ route('showLogin') }}"><i class="fa fa-sign-in fa-fw"></i></a>
                            </span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['method' => 'post', 'url' => route('userRegister')]) }}
                        <fieldset>
                            {{--hanldes auth->failed msg--}}
                            @if(session()->has('failed'))
                                <div class="text-danger text-center">
                                    {!! session()->get('failed') !!}
                                </div>
                            @endif
                            {{--/handles auth->failed msg--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('firstname') ? 'has-error' : "" }}">
                                        {!! $errors->first('firstname', '<span class="text-danger">:message</span>') !!}
                                        {{ Form::input('text', 'firstname' ,null, ['class' => 'form-control', 'placeholder' => 'Firstname']) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('lastname') ? 'has-error' : "" }}">
                                        {!! $errors->first('lastname', '<span class="text-danger">:message</span>') !!}
                                        {{ Form::input('text', 'lastname' ,null, ['class' => 'form-control', 'placeholder' => 'Lastname']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : "" }}">
                                {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                {{ Form::input('email', 'email' ,null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                            </div>
                            <div class="form-group {{ $errors->has('signature') ? 'has-error' : "" }}">
                                {!! $errors->first('signature', '<span class="text-danger">:message</span>') !!}
                                {{ Form::input('text','signature', null, ['class' => 'form-control', 'placeholder' => 'Digital Signature']) }}
                            </div>
                            {{ Form::submit('Sign Up',  ['class' => 'btn btn-lg btn-success']) }}
                            <span class="pull-right">
                                <a href="">Lost your password?</a>
                            </span>
                        </fieldset>
                        {{ Form::close() }}
                        <br>
                        <div class="text-center">
                            Already a member ? <a href="{{ route('showLogin') }}">Log in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop