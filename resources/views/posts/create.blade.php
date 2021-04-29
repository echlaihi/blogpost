@extends("layouts.app")


@section("content")

   <section class="container">

        <form class="container"  method="post" enctype="multipart/form-data" action="{{ route("post.store") }}">
            @csrf
            <fieldset class="form-group row">
                <label for="" class="col-12"><b>Enter the title:</b> </label>
                @error("title")
                    <div class="alert alert-danger col-12 py-2">{{ $message }}</div>                    
                @enderror
                <textarea class="form-control col-12" name="title" id=""rows="1">{{ old("title") ? old("title") : ""}}</textarea>
            </fieldset>


            <fieldset class="form-group row">
                
                <label for="" class="col-12" ><b>Enter the body: </b> </label>
                @error("body")
                <div class="alert alert-danger col-12 py-2">{{ $message }}</div>                    
                @enderror
                <textarea name="body" id="" class="form-control col-12" rows="22">{{ old("body") ? old("body") : "" }}</textarea>
            </fieldset>

            <fieldset class="form-group row">

                <label for="" class=""><b>Shoose an Image: </b></label>

                @error("img")
                    <div class="d-block py-1 form-control alert alert-danger">{{ $message  }}</div>
                @enderror
                <input class="form-control py-1" type="file" name="img">

            </fieldset>

            <fieldset class="form-group row">
                <input type="submit" name="submit" value="Save" class="btn btn-success col-2 mr-2">
            </fieldset>
        </form>

   </section>

@endsection