{{ Form::open(['method' => 'post', 'url' => route('userRegister')]) }}
<fieldset>
    {{--hanldes auth->failed msg--}}
    @if(session()->has('reg-failed'))
        <div class="text-danger text-center">
            {!! session()->get('reg-failed') !!}
        </div>
    @endif
    <div class="form-group {{ $errors->has('firstname') ? 'has-error' : "" }}">
        {!! $errors->first('firstname', '<span class="text-danger">:message</span>') !!}
        {{ Form::input('text', 'firstname' ,null, ['class' => 'form-control', 'placeholder' => 'Firstname']) }}
    </div>
    <div class="form-group {{ $errors->has('lastname') ? 'has-error' : "" }}">
        {!! $errors->first('lastname', '<span class="text-danger">:message</span>') !!}
        {{ Form::input('text', 'lastname' ,null, ['class' => 'form-control', 'placeholder' => 'Lastname']) }}
    </div>
    <div class="form-group {{ $errors->has('email') ? 'has-error' : "" }}">
        {!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
        {{ Form::input('email', 'email' ,null, ['class' => 'form-control', 'placeholder' => 'Email']) }}
    </div>

    {!! $errors->first('contact', '<span class="text-danger">:message</span><br>') !!}
    <div class="form-group input-group {{ $errors->has('contact') ? 'has-error' : "" }}">
        <span class="input-group-addon">+63</span>
        {{ Form::input('text', 'contact', null, ['class' => 'form-control', 'placeholder' => 'Contact Number']) }}
    </div>
    <div class="form-group {{ $errors->has('gender') ? 'has-error' : "" }}">
        {!! $errors->first('gender', '<span class="text-danger">:message</span>') !!}
        {{ Form::select('gender', ['' =>'Gender','male' => 'Male', 'female' => 'Female'], null, ['class' => 'form-control'])}}
    </div>
    <div class="form-group {{ $errors->has('bday') ? 'has-error' : "" }}">
        <label for="bday">Birthday:</label>
        {!! $errors->first('bday', '<span class="text-danger">:message</span>') !!}
        {{ Form::date('bday', null, ['class' => 'form-control', 'placeholder' => 'mm/dd/yyy']) }}
    </div>
    <div class="form-group {{ $errors->has('signature') ? 'has-error' : "" }}">
        {!! $errors->first('signature', '<span class="text-danger">:message</span>') !!}
        {{ Form::input('text','signature', null, ['class' => 'form-control', 'placeholder' => 'Digital Signature']) }}
    </div>
    {{ Form::submit('Sign Up',  ['class' => 'btn btn-lg btn-success']) }}
</fieldset>
{{ Form::close() }}