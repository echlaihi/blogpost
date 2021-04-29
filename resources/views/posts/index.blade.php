@extends('layouts.app')

@section("content")

    <div class="container-md">
        <div class="row">
        @foreach ($posts as $post )

            <div class="col-md-3 card">

                {{-- <img src="" class="card-img-top" /> --}}

               <div class="card-body px-0">
                   <div class="card-title">
                       {{ $post->title }}
                   </div>

                   <div class="card-text mx-0">
                       {{ $post->getExerpt() }}
                       <a href="{{ route("post.show", $post->id) }}">read more &raquo;</a>

                    </div>
                    @can("manage", $post)
                    <a href="{{ route("post.edit", $post->id) }}" class="btn btn-sm btn-info">edit</a>
                    @endcan
               </div>

            </div>
            
            
        @endforeach
        </div>
    </div>

@endsection