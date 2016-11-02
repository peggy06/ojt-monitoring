<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="navbar-brand">
            <a href="{{ route('adminDashboard') }}">
                <img src="{{ asset('images/new_logo_invert.png') }}" class="img-responsive" width="100" alt="">
            </a>
        </div>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="requestTrigger">
                <i class="fa fa-bullhorn fa-fw"></i>
                @if($permissions->where(['to' => auth('admin')->user()->id, 'accepted' => 0])->count() != 0)
                    <span class="badge small" id="requestBadge">{{$permissions->where(['to' => auth('admin')->user()->id, 'accepted' => 0])->count()}}</span>
                @endif
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages dropdown-scroll">
                <iframe src="{{route('loadRequest')}}" frameborder="0" height="100%" width="100%" style="overflow-x: hidden"></iframe>
            </ul>
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ route('adminLogout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </li>
        <!-- /.dropdown -->

    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li>
                    <a href="{{ route('adminProfile') }}">
                        <div class="row">
                            <div class="col-md-3 col-sm-2 col-xs-2">
                                <img src="{{ asset($users->find(auth('admin')->user()->id)->profile->avatar) }}" width="50px" class="img-circle pull-left" alt="">
                            </div>
                            <div class="col-md-9 col-sm-10 col-xs-10" style="margin-top: 5px;">
                                <span class="pull-left">{{ auth('admin')->user()->name }} <br> <span class="small">View Profile</span></span><br>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider">&nbsp;</li>
                <li>
                    <a href="{{ route('adminDashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('adminInbox') }}"><i class="fa fa-inbox fa-fw"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('adminCollectionAdviser') }}">Advisers</a>
                        </li>
                        <li>
                            <a href="{{ route('adminCollectionStudent') }}">Students</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="{{ route('adminLogs') }}"><i class="fa fa-list-alt fa-fw"></i> Activity Log</a>
                </li>
                <li>
                    <a href="{{ route('adminCourseAndSection') }}"><i class="fa fa-university fa-fw"></i> Course and Section</a>
                </li>
                <li>
                    <a href="{{ route('adminCompany') }}"><i class="fa fa-building fa-fw"></i> Partner Companies</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<script>
    $(document).ready(function(){
        $("#requestTrigger").click(function(){
            $("#requestBadge").hide();
        });
    });
</script>