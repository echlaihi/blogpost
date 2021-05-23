@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header "><span>{{ __('Dashboard') }}</span> <a class="ml-5 btn btn-info block mr-auto" href="{{ route('post.create') }}">creer un publication</a></div>

                <div class="card-body container">

                    <div class="row">

                        <div class="col-md-4">
                                {{-- ==== notifications =============================================== --}}
                                    @include('auth.aside')
                                {{-- ==== end notifications =============================================== --}}
                        </div>

                        <div class="col-md-8">
                            {{-- ====== posts table======================================================================================= --}}
                                @include('auth.posts')
                            {{-- ==== end posts table ==================================================================================== --}}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
