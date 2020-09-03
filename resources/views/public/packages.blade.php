@extends('public')

@section('content')
    <div class="w-screen-responsive mx-auto py-8">
        <h2 class="mx-4 text-responsive font-semibold md:hidden">Packages</h2>
        <package-collection
            :packages='{{ $packages }}'
        ></package-collection>
    </div>
@endsection

@section('end-script')
@endsection