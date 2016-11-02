@extends('templates.master')

@section('content')
    <ul class="list-unstyled">
        @if($notifications->where(['removed' => 0, 'to' => auth()->user()->id])->count() == 0)
            <li style="padding: 5px 15px 0px 15px;">
                <div>
                    <strong>No Notifications found</strong>
                </div>
            </li>
        @else
            @foreach($sorted_notifications as $notif)
                <li style="padding: 5px 15px 0px 15px;">
                    <div>
                        <strong>{{ $users->where('id', $notif['poser'])->first()->name }}</strong>
                        <span class="pull-right text-muted">{{  $notifications->where('created_at', $notif['created_at'])->first()->created_at->diffForHumans()  }}
                            <a href="{{ route('adviserRemoveNotification', encrypt($notif['id'])) }}"><i class="fa fa-times fa-fw pull-right"></i></a></span>
                    </div>
                    <div>
                        <br>
                        {{ $notif['event'] }}<br>
                    </div>
                </li>
                <hr>
            @endforeach
        @endif
    </ul>
@stop