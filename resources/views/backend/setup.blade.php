@extends('templates.master')

@section('content')
    @include('backend.templates.nav')
    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="well well-lg">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Admin Account Setup</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['method' => 'post', 'url' => route('adminInstall')]) }}
                        <fieldset>
                            {{--hanldes auth->failed msg--}}
                            @if(session()->has('setup-failed'))
                                <div class="text-danger text-center">
                                    {!! session()->get('setup-failed') !!}
                                </div>
                            @endif
                            <div class="form-group {{ $errors->has('firstname') ? 'has-error' : "" }}">
                                {!! $errors->first('firstname', '<span class="text-danger">:message</span>') !!}
                                {{ Form::input('text', 'firstname' ,null, ['class' => 'form-control', 'placeholder' => 'Firstname']) }}
                            </div>
                            <div class="form-group {{ $errors->has('lastname') ? 'has-error' : "" }}">
                                {!! $errors->first('lastname', '<span class="text-danger">:message</span>') !!}
                                {{ Form::input('text', 'lastname' ,null, ['class' => 'form-control', 'placeholder' => 'Lastname']) }}
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : "" }}">
                                {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
                                {{ Form::input('email', 'email' ,null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                            </div>
                            {!! $errors->first('contact', '<span class="text-danger">:message</span><br>') !!}
                            <div class="form-group input-group {{ $errors->has('contact') ? 'has-error' : "" }}">
                                <span class="input-group-addon">+63</span>
                                {{ Form::input('text', 'contact', null, ['class' => 'form-control', 'placeholder' => 'Contact Number']) }}
                            </div>
                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : "" }}">
                                {!! $errors->first('gender', '<span class="text-danger">:message</span>') !!}
                                {{ Form::select('gender', ['' =>'Gender','male' => 'Male', 'female' => 'Female'], null, ['class' => 'form-control'])}}
                            </div>
                            <div class="form-group {{ $errors->has('key') ? 'has-error' : "" }}">
                                {!! $errors->first('key', '<span class="text-danger">:message</span>') !!}
                                {{ Form::input('text', 'key' ,null, ['class' => 'form-control', 'placeholder' => 'APP-key: xxxxxxxxxxxxxxxx']) }}
                            </div>
                            {{ Form::submit('Sign Up',  ['class' => 'btn btn-lg btn-success']) }}
                        </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop