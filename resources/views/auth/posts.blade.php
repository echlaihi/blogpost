
       
        @if (count($posts))

        <table class="table-striped">
            <thead>
                <tr>
                    <th>titre</th>
                    <th>Text</th>
                    <th>cree le</th>
                    <th>Options</th>
                </tr>
            </thead>

            <tbody>

        @foreach ($posts as $post)

            <tr>
                <td class="mx-5">{{ $post->titleExcerpt() }}</td>
                <td class="mx-5">{{ $post->getExtraExerpt() }}</td>
                <td class="mx-5">{{ $post->created_at->diffForHumans() }}</td>

                <td class="mx-5 d-flex">

                    <a class="btn btn-sm btn-info mr-2" href="{{ route('post.show', $post->id) }}">Voir</a>

                    <form id="form" action="{{ route('post.destory', $post->id) }}" method="post">
                    
                        @method('DELETE')
                        @csrf
                        <input type="button" id="btn" value="Suprimer" class="btn btn-sm btn-danger">
                    </form>

                    <script>
                        var btn = document.getElementById('btn');
                        var form = document.getElementById('form');
                       
                       btn.addEventListener('click', function () {
                        if (confirm('Voulez-vous vraiment suprimer cette publication?')){
                            form.submit();
                        }
                       });
                    </script>

                </td>
            </tr>
            
        @endforeach

    </tbody>
</table>

    

@else

    <div class="alert alert-danger">vous n'avez aucune publication</div>

@endif