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
                        <h4>Register Successful!</h4>
                    </div>
                    <div class="panel-body">
                        <p>
                            Admin account has been successfully setup! <a href="{{ route('adminIndex') }}">Login</a> your account to continue
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop