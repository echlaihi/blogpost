@extends('admin.layout')

@section('table')
<div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><b>Les utilisateur:</b> </h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <tr>
          <th>Nom</th>
          <th>Email</th>
          <th>regoindre</th>
        </tr>

        @foreach ($users as $user )

            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
            </tr>
                
        @endforeach
        
    </table>
    {{ $users->links() }}
</div>
</div>

@endsection