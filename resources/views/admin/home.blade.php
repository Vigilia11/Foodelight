<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @include('modal.user.homeModal')
    <div class="py-12 min-h-screen bg-white">
        <div class="max-w-6xl mx-auto">

            <div>
                <h1 class="text-2xl font-semibold text-rose-500">MOST REQUESTED</h1>
                <div class="grid grid-cols-7 gap-2">
                    @for($i=1;$i<=7;$i++)    
                        <div class="col-span-1 h-40 relative ps-2" role="button" data-modal-target="most-favorites-modal" data-modal-toggle="most-favorites-modal">
                            <div class="absolute bottom-0 -left-1 z-10 text-white text-4xl font-extrabold" style="text-shadow: 4px 4px 8px #e11d48">{{ $i }}</div>
                            <div class="h-full bg-white shadow rounded-md overflow-hidden">
                                <div class="w-full h-full relative">
                                    <img src="{{ asset('images/dishes/Arrozcaldo1701928874.jpg') }}" alt="" class="w-full h-full">                                    
                                </div>
                            </div>                    
                        </div>
                    @endfor
                </div>
            </div>
            
            <div class="grid grid-cols-4 mt-10">
                <div class="col-span-1 h-full">
                    <div class="h-full flex items-center">
                        <div class="w-full">
                            <h1 class="text-4xl font-extrabold text-gray-800">Most</h1>
                            <h1 class="text-5xl font-extrabold text-indigo-600">Favorites</h1>
                        </div>
                    </div>
                </div>
                <div class="col-span-3">
                    <div class="grid grid-cols-5 gap-2">
                        @for($i=1;$i<=5;$i++)    
                            <div class="col-span-1 h-36 relative ps-4">
                                <div class="absolute top-0 -left-2 text-white text-6xl font-extrabold" style="text-shadow: 4px 4px 8px #9333ea">{{ $i }}</div>
                                <div class="p-4 h-full bg-white shadow">
                                    <div class="w-full h-full "></div>
                                </div>                    
                            </div>      
                        @endfor
                    </div>
                </div>                
            </div>

            <div class="mt-10">
                <h1 class="text-2xl font-semibold text-gray-800 text-center mb-5">Available Today</h1>
                    <div class="mt-5">
                        <h1 class="text-2xl font-semibold text-gray-800 mb-1">Meals</h1>
                        <div class="grid grid-cols-4 gap-5">
                            @for($i=1;$i<=8;$i++)  
                                <div class="bg-white dish">
                                    <div class="h-60 relative overflow-hidden">
                                        <img src="{{ asset('images/dishes/Arrozcaldo1701928874.jpg') }}" alt="" class="w-full h-full">
                                        <div class="absolute bottom-0 left-0 z-10 py-2 w-full grid grid-cols-2 button-container bg-white">
                                            <div class="border-r border-gray-200 flex justify-center items-center gap-2">
                                                <button type="button" data-modal-target="UserReaction" data-modal-toggle="UserReaction" class="text-gray-900 hover:text-blue-700 text-md font-medium">
                                                    123
                                                </button>
                                                <button type="button" class="text-black hover:text-rose-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class=" flex justify-center items-center">
                                                <button type="button" class="text-black hover:text-sky-600" data-modal-target="modal-details" data-modal-toggle="modal-details">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative overflow-hidden py-2">
                                        <div class="p-1">
                                            <h6 class="text-black text-lg font-bold ">Dish</h6>
                                            <h6 class="text-lime-600 ">Price</h6>
                                        </div>
                                        <div class="w-full absolute bottom-0 left-0 z-10 py-1.5 order bg-white">
                                            <button type="button" data-modal-target="modal-dish-order" data-modal-toggle="modal-dish-order" class="bg-lime-600 hover:bg-black text-white px-2 py-1 text-sm rounded-sm">Order now</button>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
            </div>
        </div>            
    </div>
</x-app-layout>