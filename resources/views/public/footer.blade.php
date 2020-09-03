<footer class="pl-16 py-4 sm:pl-0 w-full bg-gray-300 flex flex-col justify-start items-center">
    <div class="w-full mb-4 px-6 flex flex-col justify-center sm:hidden">
        <p class="lg:max-w-96 text-sm text-gray-800 mb-2">Looking for a full stack web developer specialized in PHP, Laravel and VueJS? Please get in touch!</p>
        <button class="mt-3 btn bg-orange-500 text-white font-semibold">
            Hire Me
        </button>
    </div>
    
    <div class="hidden w-screen-responsive my-6 sm:flex justify-start items-stretch">
        <img class="w-18 object-contain m-4" src="{{ asset('images/logo/graphic-black.png') }}">
        <div class="ml-8 flex flex-col justify-center">
            <a href="{{ route('public.home') }}" class="cursor-pointer hover:underline">Home</a>
            <a href="{{ route('public.cv') }}" class="cursor-pointer hover:underline">CV</a>
            <a href="{{ route('public.packages') }}" class="cursor-pointer hover:underline">Packages</a>
        </div>
        <div class="ml-16 lg:ml-8 lg:ml-0 flex flex-col justify-center items-start lg:flex-grow lg:flex-row lg:justify-center lg:items-center">
            <p class="mr-6 max-w-96 text-base">Looking for a full stack web developer specialized in PHP, Laravel and VueJS? Please get in touch!</p>
            <button @click="events.publish('show-hire-me-modal')" class="ml-32 mt-3 lg:ml-0 lg:mt-0 btn bg-orange-500 text-white font-semibold">
                Hire Me
            </button>
        </div>
    </div>
    <span class="text-xs">Copyright © {{ \Carbon\Carbon::now()->format('Y') }} - Kurt Friars</span>
</footer>