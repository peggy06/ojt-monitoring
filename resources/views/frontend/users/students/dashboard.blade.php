@extends('templates.map')


    <div id="wrapper">
        <!-- Navigation -->
        @include('frontend.users.students.templates.nav')
                <!-- Page Content -->
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            @if($users->find(auth()->user()->id)->profile->company_id == 0)
                                Map
                            @else
                                Profile
                            @endif
                        </div>
                        <div class="panel-body">
                            @if($users->find(auth()->user()->id)->profile->company_id == 0)
                                <div class="row">
                                    <div class="col-md-6">
                                        @include('frontend.users.students.templates.map')
                                    </div>
                                    <div class="col-md-6">
                                        Company Name: <br>
                                        <strong id="name"> N/A</strong><br><br>
                                        Address: <br>
                                        <strong id="address"> N/A</strong>
                                        {{ Form::open(['method' => 'post', 'url' => route('studentAddCompany')]) }}
                                        {{ Form::hidden('company_name', null, ['id' => 'company_name']) }}
                                        {{ Form::hidden('company_address', null, ['id' => 'company_address']) }}
                                        {{ Form::hidden('company_lat', null, ['id' => 'company_lat']) }}
                                        {{ Form::hidden('company_lng', null, ['id' => 'company_lng']) }}
                                        {{ Form::submit('Add as Company Choice', ['class' => 'btn btn-primary btn-sm pull-right', 'style' => 'display: none', 'id' => 'addCompany']) }}
                                        {{ Form::close() }}
                                        <br>
                                        <hr>
                                        @if($choices->count() != 0)
                                            <div class="chat-panel panel panel-default">
                                                <div class="panel-heading">Company Choice</div>
                                                <div class="panel-body">
                                                    <table class="table table-striped table-bordered table-hover ">
                                                        <thead>
                                                        <tr class="small">
                                                            <td>Company Name</td>
                                                            <td>Action</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="small">
                                                        @foreach($choices as $choice)
                                                            <tr>
                                                                <td>{{ $choice->name }}</td>
                                                                <td>
                                                                    <a href="{{ route('studentSetCompany', $choice->id) }}" class="btn btn-success btn-xs">Set as OJT Company</a>
                                                                    <a href="{{ route('showRecommendation', $choice->id) }}" class="btn btn-primary btn-xs">View Letter</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <span class="fa fa-user fa-fw"></span> Personal Information
                                            </div>
                                            <div class="panel-body">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span class="lead">
                                                            {{ auth()->user()->name }}
                                                        </span><br>
                                                        <span class="small text-muted">
                                                            <span class="fa fa-phone fa fw"></span>&nbsp; 0{{ $users->find(auth()->user()->id)->profile->contact }}
                                                        </span><br>
                                                        <span class="small text-muted">
                                                            @&nbsp; {{ auth()->user()->email }}
                                                        </span><br>
                                                        <span class="small text-muted">
                                                            <span class="fa fa-institution fa-fw"></span>&nbsp; {{ $course->code }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-danger">
                                            <div class="panel-heading">
                                                <span class="fa fa-building fa-fw"></span> Company Information
                                            </div>
                                            <div class="panel-body" style="overflow-y: scroll">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span class="lead">
                                                            {{ $company->find($users->find(auth()->user()->id)->profile->company_id)->first()->name }}
                                                        </span><br>
                                                        <span class="small text-muted">
                                                            <span class="fa fa-phone fa fw"></span>&nbsp; 0
                                                        </span><br>
                                                        <span class="small text-muted">
                                                            <span class="fa fa-map-marker fa-fw"></span>&nbsp; {{ $company->find($users->find(auth()->user()->id)->profile->company_id)->first()->address }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <span class="fa fa-bar-chart fa-fw"></span> Progress
                                            </div>
                                            <div class="panel-body">
                                                <span class="lead">
                                                    {{ number_format($progress, 2) }}%
                                                </span><br>
                                                        <br>
                                                <span class="small">
                                                    Total Hour(s) Rendered: {{ number_format($users->find(auth()->user()->id)->profile->number_of_hours_rendered  / 60 / 60, 0) }} hrs <br>
                                                    No. of Training Hours Required: {{ $hours->hours }} hrs
                                                </span><br>&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="chat-panel panel panel-default" style="">
                                            <div class="panel-heading">
                                                <span class="fa fa-clock-o fa-fw"></span> DTR <span class="small text-muted">(Daily Time Record)</span>
                                            </div>
                                            <div class="panel-body">

                                                <div id="loadingCoordinates" class="panel-body text-center" style="display:none;position: absolute;top: 0; left: 0;width: 100%;height: 100%; background-color: #e2e2e2;z-index: 1;opacity: 0.8">
                                                    <br><span class="lead">
                                                        Please wait for a while ... <br>
                                                        <span class="small text-muted">We're fetching your coordinates</span>
                                                    </span>
                                                </div>
                                                <div class="well well-md">
                                                    {{ Form::open(['method' => 'post', 'url' => route('timeIn')]) }}
                                                    {{ Form::hidden('myLat', null, ['id' => 'myLat'] ) }}
                                                    {{ Form::hidden('myLng', null, ['id' => 'myLng'] ) }}
                                                    <span class="text-danger" id="coordinatesAlert">
                                                        @if(session()->has('far'))
                                                            {{ session()->get('far') }}
                                                        @endif
                                                    </span><br>
                                                    <div class="btn-group">
                                                        @if($today_record->count() != 0)
                                                        <button type="submit" class="btn {{ $today_record->first()->status == 1 ? 'btn-default disabled' : 'btn-success' }}" id="btnTimeIn" {{ $today_record->first()->status == 1 ? 'disabled' : '' }}> <span class="fa fa-clock-o fa-fw"></span> Time-in</button>
                                                        <a data-toggle="modal" data-target="#timeOutModal" class="btn {{ $today_record->first()->status == 1 ? 'btn-danger' : 'disabled btn-default' }}"> <span class="fa fa-sign-out fa-fw"></span>Time out</a>
                                                        @else
                                                            <button type="submit" class="btn btn-success" id="btnTimeIn"> <span class="fa fa-clock-o fa-fw"></span> Time-in</button>
                                                            <a data-toggle="modal" data-target="#timeOutModal" class="btn disabled btn-default"> <span class="fa fa-sign-out fa-fw"></span>Time out</a>
                                                        @endif
                                                    </div>
                                                    {{ Form::close() }}

                                                </div>
                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                    <thead>
                                                        <tr>
                                                            <td>Date</td>
                                                            <td>Time-in</td>
                                                            <td>Time-out</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       @if($dtr->count != 0)
                                                       	 @foreach($dtr as $time_record)
                                                            <tr>
                                                                <td>{{ $time_record->date }}</td>
                                                                <td>{{ $time_record->created_at->format('h:i:s a') }}</td>
                                                                <td>{{ $time_record->updated_at->format('h:i:s a') }}</td>
                                                            </tr>
                                                        @endforeach
                                                       @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="chat-panel panel panel-default">
                                            <div class="panel-heading">
                                                users
                                            </div>
                                            <div class="panel-body">
                                                &nbsp;
                                                {{ Carbon\Carbon::now()->diffInWeeks(\Carbon\Carbon::create(2016, 10, 31 )) }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <div class='modal fade' id='timeOutModal' role='dialog'>
                            <div class='modal-dialog modal-sm'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                        <h4 class='modal-title'>Time-out</h4>
                                    </div>
                                    <div class='modal-body'>
                                        <div class="article">

                                           <span class="fa fa-exclamation-triangle fa-3x pull-left text-danger"></span>
                                            @if($today_record->count() !=  0)
                                            	@if($today_record->first()->created_at->diffInHours(Carbon\Carbon::now()) < 8)
                                                <span class="text-danger small">This will be register as UNDERTIME</span><br>
                                            @endif
                                            @endif
                                            Are you sure you want to Time out ?
                                            <br>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <div class="pull-right">
                                            <a href="{{ route('timeOut') }}" class="btn btn-danger btn-md"> Yes</a>
                                            <button type='button' class='btn btn-primary' data-dismiss='modal'> No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            {{--<script>--}}
                                {{--window.onload = function () {--}}
                                    {{--navigator.geolocation.getCurrentPosition(c);--}}
                                    {{--return false;--}}
                                {{--}--}}

                                {{--var c = function (pos) {--}}
                                    {{--var myLat = pos.coords.latitude;--}}
                                    {{--var myLng = pos.coords.longitude;--}}

                                    {{--document.getElementById('myLat').value=myLat;--}}
                                    {{--document.getElementById('myLng').value=myLng;--}}
                                    {{--var deg2rad = Math.PI/180;--}}
{{--//                                    var latFrom = myLat * deg2rad;--}}
{{--//                                    var lngFrom = myLng * deg2rad;--}}
                                    {{--var latFrom = 0.25814353388146; //tentative , to test time-in--}}
                                    {{--var lngFrom = 2.1131014365963;--}}
                                    {{--var latTo = {{ deg2rad($company->find($users->find(auth()->user()->id)->profile->company_id)->first()->latitude) }};--}}
                                    {{--var lngTo = {{ deg2rad($company->find($users->find(auth()->user()->id)->profile->company_id)->first()->longitude) }};--}}
                                    {{--var earthRadius = 6371000;--}}

                                    {{--var latDelta = latTo - latFrom;--}}
                                    {{--var lngDelta = lngTo - lngFrom;--}}
                                    {{--var angle = 2 * Math.asin(Math.sqrt(Math.pow(Math.sin(latDelta / 2), 2) + Math.cos(latFrom) * Math.cos(latTo) * Math.pow(Math.sin(lngDelta / 2), 2)));--}}
                                    {{--var distance = angle * earthRadius;--}}

                                    {{--if(distance > 50){--}}
                                        {{--document.getElementById('btnTimeIn').setAttribute('disabled', 'true');--}}
                                        {{--document.getElementById('coordinatesAlert').innerHTML="Too far from the company";--}}
                                    {{--}--}}

                                    {{--if(document.getElementById('myLat').value != 0){--}}
                                        {{--document.getElementById('loadingCoordinates').setAttribute('style', 'display: none');--}}
                                    {{--}--}}

                                {{--}--}}
                            {{--</script>--}}
                        @endif
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

