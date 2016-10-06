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
                        <h1 class="page-header">My Signature</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-pencil fa-fw"></i> Digital Signature
                            <div class="pull-right">
                                <ul class="list-inline">
                                    <li><span class="fa fa-plus-circle fa-fw"></span></li>
                                    <li><span class="fa fa-minus-circle fa-fw"></span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            {{ Form::open(['method' => 'post', 'url' => route('generateSignature'), 'class' => 'form-inline']) }}
                            <fieldset>
                                {{--hanldes auth->failed msg--}}
                                @if(session()->has('failed'))
                                    <div class="text-danger text-center">
                                        {{ session()->get('failed') }}
                                    </div>
                                @endif
                                {{--/handles auth->failed msg--}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('count') ? 'has-error' : "" }}">
                                            {!! $errors->first('count', '<span class="text-danger">:message</span>') !!}
                                            <label for="count" class="form-inline">How many signature(s) to generate?</label>
                                            {{ Form::select('count', [
                                                1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5',
                                                6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                                                 null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        {{ Form::submit('Generate',  ['class' => 'btn btn-md btn-success pull-left']) }}
                                    </div>
                                </div>
                            </fieldset>
                            {{ Form::close() }}
                            <br>
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>Signature</th>
                                        <th>Used by</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach( $current_user->signatures as $user)
                                    <tr class="odd gradeX">
                                        <td>{{ $user->signature }}</td>
                                        <td>{{ $user->used_by == null ? "Not Used" : "Used" }}</td>
                                        <td class="center"><a href="">View Details</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop