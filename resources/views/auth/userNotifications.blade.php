@extends('layouts.app')

@section('table')
<div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><b>Les Notifications:</b> </h3>

    </div>
    <div class="panel-body">

        
        @if($notifications->count() == 0) 
            <div class="alert alert-info">Pas de notifications.</div>
        @endif
        @foreach ($notifications as $notification )

            <div class="alert alert-info d-flex justify-content-space-between">

                
                {{ $notification->data['title'] }}
                
                  @if ($notification->type == 'App\Notifications\PostCreatedNotification')
                    <a  class="btn btn-info btn-sm" href="{{ route('post.show', $notification->data['post_id']) }}">Voir la Publication</a>
                @endif
                <a class="btn btn-danger btn-sm" href="{{ route('notification.read', $notification->id) }}">marquer come lu</a>

            </div>

                
        @endforeach
        
    </table>
</div>
</div>

@endsection