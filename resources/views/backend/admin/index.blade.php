@extends('templates.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Admin Login</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['method' => 'post', 'url' => route('login')]) }}
                            <fieldset>
                                {{--hanldes auth->failed msg--}}
                                @if(session()->has('failed'))
                                    <div class="text-danger text-center">
                                        {{ session()->get('failed') }}
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
                                <!-- Change this to a button or input when using this as a form -->
                                {{ Form::submit('Login',  ['class' => 'btn btn-lg btn-success btn-block']) }}
                            </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop