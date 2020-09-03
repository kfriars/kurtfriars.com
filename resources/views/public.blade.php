@extends('base')

@section('head-scripts')
    <script src="{{ asset('js/public.js') }}" defer></script>
@endsection

@section('body')
    <body class="min-h-screen leading-normal">
        <div class="flex flex-col min-h-screen items-center" id="public">
            <div class="flex-grow w-full">
                <responsive-header></responsive-header>

                <div class="w-full pl-12 sm:pl-0">
                    @yield('content')
                </div>
            </div>
            
            @include('public.footer')

            <hire-me-modal></hire-me-modal>
        </div>

        <script>
            var state = {};
        </script>

        @yield('end-script')
    </body>
@endsection