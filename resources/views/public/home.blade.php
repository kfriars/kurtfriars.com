@extends('public')

@section('content')
    <div class="w-screen-responsive mx-auto py-8">
        <h2 class="mx-4 text-responsive font-semibold md:hidden">Posts</h2>
        <post-collection
            :posts='{{ $posts }}'
        ></post-collection>
    </div>
@endsection

@section('end-script')
@endsection