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
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    {{--students-panel--}}
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ $users->where('role', '3')->count() }}</div>
                                        <div>Total Student(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('collectionStudent') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{--advisers-panel--}}
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="glyphicon glyphicon-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{  $users->where(['role' => '2', 'deleted' => '0'])->count()  }}</div>
                                        <div>Total Adviser(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('collectionAdviser') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{--signature-panel--}}
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-pencil fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ $signature->where('user_id', auth('admin')->user()->id)->count() }}</div>
                                        <div>Total Signature(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('signature') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{--users-panel--}}
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">{{ $logs->where('deleted', '0')->count() }}</div>
                                        <div>Total Log(s)</div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('activityLogs') }}">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
             <div class="row">
                 <div class="col-lg-4">
                             <div class="chat-panel panel panel-default" id="chat">
                                 <div class="panel-heading">
                                     <i class="fa fa-users fa-fw"></i>
                                     User List
                                     <a href="{{ route('chatRefresh') }}"><i class="fa fa-refresh fa-fw pull-right"></i></a>
                                 </div>
                                 <!-- /.panel-heading -->
                                 <div class="panel-body">
                                    <ul class="chat">
                                        @foreach($users->where(['deleted' => '0', 'confirmed' => '1'])->get() as $user)
                                            @if($user->name != auth('admin')->user()->name)
                                                <li>
                                                    {{ $user->name }}
                                                    <span class="small pull-right">
                                                     {{ $user->isOnline == 0 ? $user->updated_at->diffForHumans() : "Now" }}<span class="fa fa-circle fa-fw {{ $user->isOnline == 1 ? "text-online" : "text-muted" }}"></span>
                                                    </span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                 </div>
                                 <!-- /.panel-body -->
                             </div>
                             <!-- /.panel .chat-panel -->
                         </div>
                 <div class="col-md-4">
                     <div class="chat-panel panel panel-default">
                         <div class="panel-heading">
                             Available Signatures
                             <div class="pull-right">
                                 {{ $signature->where(['user_id' => auth('admin')->user()->id, 'used_by' => null, 'deleted' => '0'])->count() }}/{{ $signature->where(['user_id' => auth('admin')->user()->id, 'deleted' => '0'])->count() }}
                             </div>
                         </div>
                         <div class="panel-body">
                             <div class="dataTable_wrapper">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <tbody class="text-center">
                                     @foreach($signature->where(['user_id' => auth('admin')->user()->id, 'used_by' => null, 'deleted' => '0'])->get() as $sign)
                                         <tr>
                                             <td>{{ $sign->signature }}</td>
                                         </tr>
                                     @endforeach
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="chat-panel panel panel-default">
                         <div class="panel-heading">
                             Activities of the day
                         </div>
                         <div class="panel-body">
                             <div class="dataTable_wrapper">
                                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <thead>
                                     <tr>
                                         <th>User</th>
                                         <th>Activity</th>
                                         <th>Date</th>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     @foreach($logs->where('deleted', '0')->get() as $log)
                                         @if($users->where('id', $log->user_id)->first()->name != auth('admin')->user()->name && $log->created_at->format('m-d-Y') == \Carbon\Carbon::today()->format('m-d-Y'))
                                             <tr class="odd gradeX">
                                                 <td>{{ $users->where('id', $log->user_id)->first()->name }}</td>
                                                 <td>{{ $log->activity }}</td>
                                                 <td>{{ $log->created_at->diffForHumans() }}</td>
                                             </tr>
                                         @endif
                                     @endforeach
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
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


@stop