<nav class="w-full bg-white border-b border-gray-200">
    <div class="max-w-6xl mx-auto ">
        <div class="w-full px-1 sm:px-0 md:px-0 h-full flex justify-between items-end py-2">
            <div >
                <a href="{{ url('/home') }}" class="text-2xl text-black font-semibold">foo<span class="text-lime-500">delight</span></a>                
            </div>
            <div class="flex gap-3">
                <a href="{{ url('/home') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">HOME</a>                
                
                @if(Auth::user()->hasRole('admin'))
                <a href="{{ url('/users') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">USERS</a>  
                <div class="relative">
                    <button type="button" class="text-sm font-medium text-gray-600 hover:text-gray-900 flex items-center justify-between" onclick="$('div.order-menu').toggleClass('hidden');">
                        ORDER
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div class="absolute z-20 right-0 hidden w-24 order-menu">
                        <ul class="bg-white py-4 rounded-md border border-gray-200 text-sm text-gray-500">
                            <li class="py-1 px-4 hover:bg-gray-200 hover:text-gray-700"><a href="{{ url('/ordersToday') }}">Today</a></li>
                            <li class="py-1 px-4 hover:bg-gray-200 hover:text-gray-700"><a href="{{ url('/ordersAll') }}">All</a></li>
                        </ul>
                    </div>
                </div>
                @endif
                @if(Auth::user()->hasRole('user'))                
                <a href="{{ url('/cart') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">CART</a>
                <a href="{{ url('/order') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">ORDER</a>
                @endif
            </div>
            <div class="relative hidden md:block">
                <button type="button" class="text-sm text-gray-500 hover:text-gray-700 flex items-center justify-between" onclick="$('#account').toggleClass('hidden');">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <div class="absolute z-20 right-0 hidden w-36" id="account">
                    <ul class="bg-white py-4 rounded-md border border-gray-200 text-sm text-gray-500">
                        <li class="py-1 px-4 hover:bg-gray-200 hover:text-gray-700"><a href="{{ url('/account') }}">Account</a></li>
                        
                        <li class="py-1 px-4 hover:bg-gray-200 hover:text-gray-700"><a href="{{ url('/profile') }}">Profile</a></li>
                        
                        <li class="py-1 px-4 hover:bg-gray-200 hover:text-gray-700"><a href="#">Notification</a></li>
                        <li class="py-1 px-4 hover:bg-gray-200 hover:text-gray-700">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <!--   
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                                -->
                                <button type="submit">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="hidden sm:block md:block">
            <div class="w-full h-full flex justify-between items-center">
                <ul class="flex gap-4 text-sm font-medium text-gray-900">
                    <li class="border-b-2 border-transparent hover:border-gray-900 py-1"><a href="{{ route('meals.index') }}" class="hover:text-gray-900">MEALS</a></li>
                    <li class="border-b-2 border-transparent hover:border-gray-900 py-1"><a href="{{ url('/breads') }}" class="hover:text-gray-900">BREADS</a></li>
                    <li class="border-b-2 border-transparent hover:border-gray-900 py-1"><a href="{{ url('/cakes') }}" class="hover:text-gray-900">CAKES</a></li>
                    <li class="border-b-2 border-transparent hover:border-gray-900 py-1"><a href="{{ url('/juice') }}" class="hover:text-gray-900">JUICE</a></li>
                    <li class="border-b-2 border-transparent hover:border-gray-900 py-1"><a href="{{ url('/milktea') }}" class="hover:text-gray-900">MILKTEA</a></li>
                </ul>
            </div>
            <div></div>
        </div>
    </div>
</nav>