@extends('templates.master')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="color: #fff">Set Password
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::model('users', ['method' => 'patch', 'url' => route('setup', $user->id)]) }}
                        <fieldset>
                            {{--hanldes auth->failed msg--}}
                            @if(session()->has('failed'))
                                <div class="text-danger text-center">
                                    {{ session()->get('failed') }}
                                </div>
                            @endif
                            {{--/handles auth->failed msg--}}

                            @if($user->role == 4)
                                <div class="form-group">
                                    <label for="department">Department:</label>
                                    <select name="department" id="department" class="form-control">
                                        @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->code}}</option>
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