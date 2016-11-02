@extends('templates.master')

@section('content')
    <ul class="list-unstyled">
        @if($permissions->where(['accepted' => 0, 'to' => auth('admin')->user()->id])->count() == 0)
            <li style="padding: 5px 15px 0px 15px;">
                <div>
                    <strong>No Request found</strong>
                </div>
            </li>
        @else
            @foreach($sorted_permission as $permit)
                <li style="padding: 5px 15px 0px 15px;">
                    <div>
                        <strong>{{ $users->where('id', $permit['user_id'])->first()->name }}</strong>
                        <span class="pull-right text-muted">{{  $permissions->where('created_at', $permit['created_at'])->first()->created_at->diffForHumans()  }}</span>
                    </div>
                    <div>
                        {{ $permit['request'] }}<br>
                    </div>
                    <br>
                    <div class="text-right">
                        <a href="{{ route('adminRequestAccept', encrypt($permit['id'])) }}" class="btn btn-success btn-sm">Accept</a>
                        <a href="{{ route('adminRequestReject', encrypt($permit['id'])) }}" class="btn btn-default btn-sm">Reject</a>
                    </div>
                </li>
                <hr>
            @endforeach
        @endif
    </ul>
@stop