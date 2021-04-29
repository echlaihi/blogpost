@extends("layouts.app")


@section("content")

   <section class="container">

        <form class="container" method="post" enctype="multipart/form-data" action="{{ route("post.update", $post->id) }}">
            @method("PUT")
            @csrf
            <fieldset class="form-group row">
                @error("title")
                    <div class="alert alert-danger col-12 py-2">{{ $message }}</div>                    
                @enderror
                <label for="" class="col-12"><b>Enter the title:</b> </label>
                <textarea class="form-control col-12" name="title" id=""rows="1">{{ old("title") ? old("title") : $post->title }}</textarea>
            </fieldset>

            <fieldset class="form-group row">
                @error("body")
                <div class="alert alert-danger col-12 py-2">{{ $message }}</div>                    
                @enderror

                <label for="" class="col-12" ><b>Enter the body: </b> </label>
                <textarea name="body" id="" class="form-control col-12" rows="22">{{ old("body") ? old("body") : $post->body }}</textarea>
            </fieldset>

            <fieldset class="form-group row">

                <label for="" class=""><b>Shoose an Image: </b></label>

                @error("img")
                    <div class="d-block py-1 form-control alert alert-danger">{{ $message  }}</div>
                @enderror
                <input class="form-control py-1" type="file" name="img">

            </fieldset>

            <fieldset class="form-group row">
                <input type="submit" name="submit" value="Update" class="btn btn-success col-2 mr-2">
                <a href="{{ route("post.show", $post->id) }}" class="btn btn-info col-2">Go Back</a>
            </fieldset>
        </form>

   </section>

@endsection