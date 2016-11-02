@extends('templates.master')

@section('content')
    @include('backend.templates.nav')
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="well well-lg">
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Set School Year
                            </div>
                            <div class="panel-body">

                            </div>
                        </div>
                        {{ $enc }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop