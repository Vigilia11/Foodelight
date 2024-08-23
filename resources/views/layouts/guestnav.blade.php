<nav class="md:fixed md:top-0 md:left-0 z-20 w-full bg-gray-800" >
    <div class="max-w-6xl mx-auto h-12 px-2 md:px-0">
        <div class="h-full flex justify-between items-center">
            <div class="block">
                <a href="{{ url('/') }}"><h1 class="inline text-white text-2xl">Foo</h1><h1 class="inline text-lime-600 text-2xl">Delight</h1></a>
            </div>
            <ul class="block space-x-2">
                <li class="inline"><a href="{{ route('login') }}" class="text-white text-sm">Login</a></li>
                <li class="inline"><a href="{{ route('register') }}" class="text-white text-sm">Register</a></li>
            </ul>
        </div>
        
    </div>
</nav>