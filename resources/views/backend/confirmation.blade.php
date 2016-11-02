@extends('templates.master')

@section('content')
    @include('backend.templates.nav')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Set Password
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::model('users', ['method' => 'patch', 'url' => route('adminConfirm', encrypt($admin->id))]) }}
                        <fieldset>
                            {{--hanldes auth->failed msg--}}
                            @if(session()->has('failed'))
                                <div class="text-danger text-center">
                                    {{ session()->get('failed') }}
                                </div>
                            @endif
                            {{--/handles auth->failed msg--}}
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : "" }}">
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                                {{ Form::password('password', ['id'=> 'password', 'class' => 'form-control', 'placeholder' => 'Password']) }}
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : "" }}">
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                                {{ Form::password('confirm', ['id' => 'confirm', 'class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
                            </div>
                            {{ Form::submit('Set Password',  ['class' => 'btn btn-lg btn-outline btn-success']) }}

                        </fieldset>
                        {{ Form::close() }}
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop