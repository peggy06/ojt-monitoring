@extends('templates.master')

@section('content')
    <div id="wrapper">

        <!-- Navigation -->
        @include('backend.admin.templates.nav')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Profile</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4><span class="fa fa-fw">@</span> Change Email</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                {{ Form::open(['method' => 'patch', 'url' => route('updateEmail')]) }}
                                <fieldset>
                                    @if(session()->has('failed'))
                                        <div class="text-danger text-center">
                                            {{ session()->get('failed') }}
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'New Email'] ) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::email('confirmEmail', null, ['class' => 'form-control', 'placeholder' => 'Confirm Email']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Current password']) }}
                                    </div>
                                    {{ Form::submit('Update Email', ['class' => 'btn btn-success from-control']) }}
                                        <a href="{{ route('profile') }}" class="btn btn-danger btn-md">Cancel</a>
                                    {{ Form::close() }}
                                </fieldset>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
<!-- /#wrapper -->
@stop