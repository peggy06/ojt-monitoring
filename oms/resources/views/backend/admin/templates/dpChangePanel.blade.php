{{ Form::open(['method' => 'patch', 'url' => route('changeDP'), 'files' => true]) }}

<div class="form-group {{ $errors->has('image') ? 'has-error' : "" }}">
    {!! $errors->first('image', '<span class="text-danger">:message</span>') !!}
    {{ Form::file('image', null)}}
    <span class="small text-info pull-right">File size limit (2mb)</span><br>
</div>
{{ Form::submit('Upload', ['class' => 'btn btn-primary pull-right'])}}