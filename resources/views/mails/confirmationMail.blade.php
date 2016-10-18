@extends('templates.master')

@section('content')
    <div class="container">
        Hi {{ $firstname }},
        <p>
            Thank you for registering with <a href="ojt-monitoring.herokuapp.com/public">ojt-monitoring.herokuapp.com</a> and allowing us to monitor your path to success.
            <br>
            <a href="{{ route('userConfirmation', $code) }}">Please use this link to complete your registration</a>
            <br>
        </p>
        Thanks,<br>
        OJT Monitoring BOTS
    </div>
@stop