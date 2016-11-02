
<nav class="navbar navbar-default navbar-static-top nav-users" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="{{ asset('images/new_logo.png') }}" alt="" width="150" class="img-responsive">
        </div>
        <!-- /.navbar-header -->
        <div class="container navbar-collapse">
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    {{ Form::open(['method' => 'post', 'url' => route('userLogin'), 'class' => 'form-inline']) }}
                    <fieldset>
                        {{--hanldes auth->failed msg--}}


                        @if(session()->has('failed'))
                            <div class="text-danger text-center">
                                {!!   session()->get('failed') !!}
                            </div>
                        @else
                            <div class="text-danger text-center">
                                &nbsp;
                            </div>
                        @endif
                        {{--/handles auth->failed msg--}}
                        <div class="form-group  {{ $errors->has('password') ? 'has-error' : "" }}">
                            {{ Form::input('email', 'email',null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : "" }}">

                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                        </div>
                        {{ Form::submit('Login',  ['class' => 'btn btn-lg btn-primary btn-sm']) }}
                        <br>
                        <span class="pull-right" >
                                <a href="" style="color: #fff !important;">Lost your password?</a>
                        </span>
                        <br>&nbsp;
                    </fieldset>
                    {{ Form::close() }}
                </li>
            </ul>
        </div>
    </div>
</nav>