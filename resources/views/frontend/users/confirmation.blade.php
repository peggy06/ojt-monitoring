@extends('templates.master')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="color: #fff">Set Password
                            <span class="pull-right">
                                <a href="{{ route('showLogin') }}"><i class="fa fa-sign-in fa-fw"></i></a>
                            </span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::model('users', ['method' => 'patch', 'url' => route('setup', $vCode->user_id)]) }}
                        <fieldset>
                            {{--hanldes auth->failed msg--}}
                            @if(session()->has('failed'))
                                <div class="text-danger text-center">
                                    {{ session()->get('failed') }}
                                </div>
                            @endif
                            {{--/handles auth->failed msg--}}

                            @if($user->where('id', $vCode->user_id)->first()->role == 2)
                                <div class="form-group">
                                    <label for="department">Department:</label>
                                    <select name="department" id="department" class="form-control">
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->prefix}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : "" }}">
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                                {{ Form::password('password', ['id'=> 'password', 'class' => 'form-control', 'placeholder' => 'Password']) }}
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : "" }}">
                                {!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
                                {{ Form::password('confirm', ['id' => 'confirm', 'class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
                            </div>
                            {{ Form::submit('Finish',  ['class' => 'btn btn-lg btn-outline btn-success']) }}

                        </fieldset>
                        {{ Form::close() }}
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop