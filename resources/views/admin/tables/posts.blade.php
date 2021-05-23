@extends('admin.layout')

@section('table')
<div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><b>Les publications:</b> </h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <tr>
          <th>Titre:</th>
          <th>Autheur:</th>
          <th>Cree le: </th>
          <th>Options: </th>
        </tr>

        @foreach ($posts as $post )

            <tr>
                <td>{{ $post->titleExcerpt() }}</td>
                <td>autheur</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
                <td class="d-flex">

                    <a class="btn btn-sm btn-default" href="{{ route('post.show', $post->id) }}">Voir</a>

                    <a class="btn btn-sm btn-info" href="{{ route('post.edit', $post->id) }}">Modifier</a>

                    <a class="btn btn-sm btn-danger" href="{{ route('post.destory', $post->id) }}">Suprimer</a>

                </td>

            </tr>
                
        @endforeach
        
    </table>
            {{ $posts->links() }}
</div>
</div>
@endsection