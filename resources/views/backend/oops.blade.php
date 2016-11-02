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
                        <h4>Oops ... Something wrong </h4>
                    </div>
                    <div class="panel-body">
                        <p>
                            Sorry for the inconvenient, we're fixing this problem . From now try to <a href="{{ route('pageRefresh') }}">refresh</a> the page
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop