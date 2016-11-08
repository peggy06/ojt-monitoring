@extends('templates.master')

@section('content')
    <div class="container">
        Hi {{ $firstname }},
        <p>
            Thank you for registering with <a href="ojt-monitoring.herokuapp.com/public">ojt-monitoring.herokuapp.com</a> as admin and giving your precious time, to OJT Student's, to monitor their success.
            <br>
            <a href="{{ route('adminConfirmation', encrypt($code)) }}">Please use this link to complete your registration</a>
            <br>
        </p>
        Thanks,<br>
        OJT Monitoring BOTS
    </div>
@stop