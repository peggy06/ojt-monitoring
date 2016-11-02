@extends('templates.master')

@section('content')
    @include('frontend.templates.nav')
    <br>
    <br>
    <div class="container">
        <div class="page-wrapper">
            <div class="wrapper">
                <div class="row">
                    <div class="col-md-4">
                        <div class="well well-lg">
                            <h4>Register...</h4>
                            @include('frontend.templates.reg-form')
                        </div>
                    </div>
                    <div class="col-md-8" style="padding-top: 150px;" >
                        <img src="{{ asset('images/banner2.png') }}" alt="banner" width="550" class="img-responsive pull-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop