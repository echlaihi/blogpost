@extends("layouts.app")

@section("content")

    <section class="container-md">

        <article>

            @can("manage", $post)
                <a class="btn btn-info" href="{{ route("post.edit", $post->id) }}">edit</a>
            @endcan

            <h1 class="py-3     text-center">{{ $post->title }}</h1>
            <img src="{{ "/storage/" . $post->img }}" alt="image" style="width: 100%; height: 100%;" class="row d-block mx-auto my-3">

            <div style="line-height: 2rem;">{{ $post->body }}</div>

        @can("manage", $post)

           <div class="d-flex">
            <a class="btn btn-info mr-3" href="{{ route("post.edit", $post->id) }}">edit</a>
            <form action="{{ route('post.destory', $post->id) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="Sumprimer" class="btn btn-danger">
            </form>
           </div>
            
        @endcan
        </article>
        
    </section>

@endsection