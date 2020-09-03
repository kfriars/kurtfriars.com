<div class="mb-10">
    <div class="sm:hidden flex flex-col justify-start items-stretch">
        <div class="flex justify-start">
            @if($logo)
            <img class="max-w-12 object-contain mr-6" src="{{ $logo }}"/>
            @endif
            <div class="flex flex-col">
                <h6 class="text-responsive font-semibold mb-1">{{ $jobTitle }}</h6>
                <p class="text-lg leading-none">{{ $company }}</p>
            </div>
        </div>
        <div class="flex justify-start my-4 ml-16 pl-2">
            <i class="fa fa-calendar-alt text-gray-700 mr-2"></i> {{ $start }} <i class="fa fa-long-arrow-alt-right text-gray-700 mx-2"></i> <i class="fa fa-calendar-alt text-gray-700 mr-2"></i> {{ $end }}
        </div>
    </div>
    <div class="hidden sm:flex justify-between items-stretch mb-3 xl:mb-1">
        <div class="flex justify-start items-stretch h-24">
            @if($logo)
            <img class="max-w-16 object-contain mr-6" src="{{ $logo }}"/>
            @endif
            <div class="max-w-64 flex flex-col justify-center">
                <h6 class="text-responsive font-semibold mb-1">{{ $jobTitle }}</h6>
                <p class="text-lg leading-none">{{ $company }}</p>
            </div>
        </div>
        <div class="flex flex-col justify-center">
            <div class="mr-4">
                <i class="fa fa-calendar-alt text-gray-700 mr-2"></i> {{ $start }} <i class="fa fa-long-arrow-alt-right text-gray-700 mx-2"></i> <i class="fa fa-calendar-alt text-gray-700 mr-2"></i> {{ $end }}
            </div>
        </div>
    </div>
    {{ $slot }}
</div>