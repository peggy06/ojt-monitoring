@extends('templates.master')

@section('content')
    <div class="wrapper">
        @include('backend.admin.templates.nav')
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Departments</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6 col-sm-7 col-xs-9">
                                        <h4>
                                            <i class="fa fa-university fa-fw"></i> Campus Departments
                                        </h4>
                                    </div>
                                    <div class="col-md-6 col-sm-5 col-xs-3">
                                        <div class="tooltip-demo pull-right">
                                            <button class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="Add Department" id="deptTrigger">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                {{ Form::open(['method' => 'post', 'url' => route('addDepartment'), 'class' => 'form-inline', 'id' => 'addDept', 'style' => 'display: none']) }}
                                    <fieldset>
                                        <div class="form-group">
                                            {{ Form::text('deptName', null, ['class' => 'form-control', 'placeholder' => 'Department Full Title']) }}
                                        </div>
                                        <div class="form-group">
                                            {{ Form::text('deptPrefix', null, ['class' => 'form-control', 'placeholder' => 'Prefix']) }}
                                        </div>
                                        {{ Form::submit('Add Department', ['class' => 'btn btn-success btn-md form-control']) }}

                                    </fieldset>

                                    <hr>
                                {{ Form::close() }}
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>Prefix</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($department->where('deleted', '0')->get() as $dept)
                                            <tr>
                                                <td>{{ $dept->name }}</td>
                                                <td>{{ $dept->prefix }}</td>
                                                <td>
                                                    <a href="">Delete</a>
                                                </td>
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
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    </div>

    <script>
        $(document).ready(function(){
            $("#deptTrigger").click(function(){
                $("#addDept").slideToggle("slow");
            });
        });
    </script>
@stop