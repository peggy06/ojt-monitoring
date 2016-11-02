@extends('templates.master')

@section('content')
    @include('backend.templates.nav')
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="well well-lg">
                    Invalid request! Your account has been confirmed already.
                </div>
            </div>
        </div>
    </div>
@stop