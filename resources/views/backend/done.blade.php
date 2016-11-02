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
                            Your registration was successful. Please check your email to confirm your account.
                        </p>
                        {{ $enc }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop