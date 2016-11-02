@extends('templates.master')

@section('content')
    @include('backend.templates.nav')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel well well-lg">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Set OJT Hours</h3>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['method' => 'post', 'url' => route('adminSetHours')]) }}
                        <fieldset>
                            {{--hanldes auth->failed msg--}}
                            @if(session()->has('failed'))
                                <div class="text-danger text-center">
                                    {{ session()->get('failed') }}
                                </div>
                            @endif
                            {{--/handles auth->failed msg--}}
                            <div class="form-group {{ $errors->has('hours') ? 'has-error' : "" }}">
                                {!! $errors->first('hours', '<span class="text-danger">:message</span>') !!}
                                {{ Form::number('hours',null, ['class' => 'form-control', 'placeholder' => 'OJT Hours']) }}
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            {{ Form::submit('Set',  ['class' => 'btn btn-lg btn-success pull-right']) }}
                        </fieldset>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop