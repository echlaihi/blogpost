@extends('admin.layout');

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

            <div class="alert alert-info">

                <form class="" method="post" action="{{ route('notification.read', $notification->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id">
                </form>
                
                {{ $notification->data['title'] }}
                
                @if ($notification->type == 'App\Notifications\PostCreatedNotification')
                    <a href="{{ route('post.show', $notification->data['post_id']) }}">Voir la Publication</a>
                @endif

            </div>

                
        @endforeach
        
    </table>
    {{-- {{ $users->links() }} --}}
</div>
</div>

@endsection