@extends('templates.master')

@section('content')
    <div class="container">
        @include('frontend.users.templates.nav')
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="color: #FFFFFF">Login
                            <span class="pull-right">
                                <a href="{{ route('showRegistration') }}"><i class="fa fa-user fa-fw"></i></a>
                            </span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['method' => 'post', 'url' => route('userLogin')]) }}
                        <fieldset>
                            {{--hanldes auth->failed msg--}}
                            @if(session()->has('failed'))
                                <div class="text-danger text-center">
                                    {!!   session()->get('failed') !!}
                                </div>
                            @endif
                            {{--/handles auth->failed msg--}}
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : "" }}">
                                {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                {{ Form::input('email', 'email',null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : "" }}">
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                            </div>
                            {{ Form::submit('Login',  ['class' => 'btn btn-lg btn-primary']) }}
                            <span class="pull-right">
                                <a href="">Lost your password?</a>
                            </span>
                        </fieldset>
                        {{ Form::close() }}
                        <br>
                        <div class="text-center">
                            Not yet registered ? <a href="{{ route('showRegistration') }}">Create an Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop