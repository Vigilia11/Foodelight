<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/dishes.css') }}">
    @include('modal.admin.modalForDishes')
    @include('modal.user.modalDishes')
    <div class="py-12 min-h-screen bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="px-1">
                <h1 class="text-2xl font-extrabold text-rose-600 mb-2 text-start">MOST FAVORITES</h1>
                <button data-modal-target="progress-modal" data-modal-toggle="most-favorites-modal" class="hidden" type="button" id="btn_show_most_favorite_modal">Toggle most favorites modal</button>

                <div class="grid  grid-cols-2 md:grid-cols-5 gap-5" id="most_favorites">
                    @for($i=1;$i<=5;$i++)
                    <div class="col-span-1 h-48 relative ps-4" role="button" data-modal-target="most-favorites-modal" data-modal-toggle="most-favorites-modal">
                        <div class="absolute top-0 -left-2 text-white text-6xl font-extrabold" style="text-shadow: 4px 4px 8px #e11d48">{{ $i }}</div>
                        <div class="p-4 h-full bg-white shadow">
                            <div class="w-full h-full "></div>
                        </div>                    
                    </div>                
                    @endfor
                </div>
            </div>
            <div class="mt-10">
                <h1 class="text-2xl font-extrabold text-gray-800 mb-2 text-start">MOST REQUESTED</h1>
                <div class="grid grid-cols-5 gap-5" id="most_requested">
                    @for($i=1;$i<=5;$i++)
                    <div class="col-span-1 h-48 relative ps-4">
                        <div class="absolute top-0 -left-2 text-white text-6xl font-extrabold" style="text-shadow: 4px 4px 8px #9333ea">{{ $i }}</div>
                        <div class="p-4 h-full bg-white shadow">
                            <div class="w-full h-full "></div>
                        </div>                    
                    </div>                
                    @endfor
                </div>
            </div>
            <div class="mt-10">
                <div class="mb-2">
                    <h1 class="text-2xl font-extrabold text-gray-800 mb-2 text-start">Meals</h1>
                    <button data-modal-target="modal-add-dish" data-modal-toggle="modal-add-dish" class="block text-white bg-lime-700 hover:bg-lime-800 font-medium rounded text-sm px-5 py-1.5 -mt-2" type="button" onclick="$('#category').val('Meal')">
                        Add Meal
                    </button>
                </div>
                    
                <div class="md:grid md:grid-flow-row md:grid-cols-4 gap-7" id="meals">
                    @for($i=1;$i<=4;$i++)
                    <div class="bg-white meal-container dish">
                        <div class="bg-gray-100 h-48 relative">

                        </div>
                        <div class="py-2.5 px-1 relative overflow-hidden">
                            <h6 class="text-black text-lg font-bold">Food</h6>
                            <div class="grid grid-cols-2">
                                <div class="text-start  text-lime-600">₱0.00/order</div>
                                <div class="text-end text-lime-600">₱0.00 whole</div>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full z-20  border-b border-gray-100 button-container" style="background-color:rgba(255,255,255,0.8)">
                                <div class="grid grid-cols-2 pb-1.5">
                                    <div class=" flex items-end justify-center">
                                        <button type="button" class="tooltip text-center text-gray-900 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                            </svg>
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-gray-800 border border-white z-10 rounded-md">Favorite</span>
                                        </button>
                                    </div>
                                    <div class="text-center flex items-center justify-center">
                                        <button type="button" class="tooltip text-center text-gray-900 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                            </svg>
                                            <span class="tooltiptext text-sm  px-2 py-1.5 text-center text-white absolute bg-gray-800 z-10 border border-white rounded-md">Request</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="mt-10">
                <div class="mb-2">
                    <h1 class="text-2xl font-extrabold text-gray-800 mb-2 text-start">Cakes</h1>
                    <button data-modal-target="modal-add-dish" data-modal-toggle="modal-add-dish" class="block text-white bg-rose-700 hover:bg-rose-800 font-medium rounded text-sm px-5 py-1.5 -mt-2" type="button" onclick="$('#category').val('Cake')">
                        Add Cake
                    </button>
                </div>
                    
                <div class="md:grid md:grid-flow-row md:grid-cols-4 gap-7" id="cakes">
                    @for($i=1;$i<=4;$i++)
                    <div class="bg-white meal-container dish">
                        <div class="bg-gray-100 h-48 relative">

                        </div>
                        <div class="py-2.5 px-1 relative overflow-hidden">
                            <h6 class="text-black text-lg font-bold">Food</h6>
                            <div class="grid grid-cols-2">
                                <div class="text-start  text-lime-600">₱0.00/order</div>
                                <div class="text-end text-lime-600">₱0.00 whole</div>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full z-20  border-b border-gray-100 button-container" style="background-color:rgba(255,255,255,0.8)">
                                <div class="grid grid-cols-2 pb-1.5">
                                    <div class=" flex items-end justify-center">
                                        <button type="button" class="tooltip text-center text-gray-900 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                            </svg>
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-gray-800 border border-white z-10 rounded-md">Favorite</span>
                                        </button>
                                    </div>
                                    <div class="text-center flex items-center justify-center">
                                        <button type="button" class="tooltip text-center text-gray-900 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                            </svg>
                                            <span class="tooltiptext text-sm  px-2 py-1.5 text-center text-white absolute bg-gray-800 z-10 border border-white rounded-md">Request</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="mt-10">
                <div class="mb-2">
                    <h1 class="text-2xl font-extrabold text-gray-800 mb-2 text-start">Breads</h1>
                    <button data-modal-target="modal-add-dish" data-modal-toggle="modal-add-dish" class="block text-white bg-orange-700 hover:bg-orange-800 font-medium rounded text-sm px-5 py-1.5 -mt-2" type="button" onclick="$('#category').val('Bread')">
                        Add Bread
                    </button>
                </div>
                    
                <div class="md:grid md:grid-flow-row md:grid-cols-4 gap-7" id="breads">
                    @for($i=1;$i<=4;$i++)
                    <div class="bg-white meal-container dish">
                        <div class="bg-gray-100 h-48 relative">

                        </div>
                        <div class="py-2.5 px-1 relative overflow-hidden">
                            <h6 class="text-black text-lg font-bold">Food</h6>
                            <div class="grid grid-cols-2">
                                <div class="text-start  text-lime-600">₱0.00/order</div>
                                <div class="text-end text-lime-600">₱0.00 whole</div>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full z-20  border-b border-gray-100 button-container" style="background-color:rgba(255,255,255,0.8)">
                                <div class="grid grid-cols-2 pb-1.5">
                                    <div class=" flex items-end justify-center">
                                        <button type="button" class="tooltip text-center text-gray-900 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                            </svg>
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-gray-800 border border-white z-10 rounded-md">Favorite</span>
                                        </button>
                                    </div>
                                    <div class="text-center flex items-center justify-center">
                                        <button type="button" class="tooltip text-center text-gray-900 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                            </svg>
                                            <span class="tooltiptext text-sm  px-2 py-1.5 text-center text-white absolute bg-gray-800 z-10 border border-white rounded-md">Request</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="mt-10">
                <div class="mb-2">
                    <h1 class="text-2xl font-extrabold text-gray-800 mb-2 text-start">Juice</h1>
                    <button data-modal-target="modal-add-dish" data-modal-toggle="modal-add-dish" class="block text-white bg-amber-400 hover:bg-amber-500 font-medium rounded text-sm px-5 py-1.5 -mt-2" type="button" onclick="$('#category').val('Juice')">
                        Add Juice
                    </button>
                </div>
                    
                <div class="md:grid md:grid-flow-row md:grid-cols-4 gap-7" id="juice">
                    @for($i=1;$i<=4;$i++)
                    <div class="bg-white meal-container dish">
                        <div class="bg-gray-100 h-48 relative">

                        </div>
                        <div class="py-2.5 px-1 relative overflow-hidden">
                            <h6 class="text-black text-lg font-bold">Food</h6>
                            <div class="grid grid-cols-2">
                                <div class="text-start  text-lime-600">₱0.00/order</div>
                                <div class="text-end text-lime-600">₱0.00 whole</div>
                            </div>
                            <div class="absolute bottom-0 left-0 w-full z-20  border-b border-gray-100 button-container" style="background-color:rgba(255,255,255,0.8)">
                                <div class="grid grid-cols-2 pb-1.5">
                                    <div class=" flex items-end justify-center">
                                        <button type="button" class="tooltip text-center text-gray-900 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                            </svg>
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-gray-800 border border-white z-10 rounded-md">Favorite</span>
                                        </button>
                                    </div>
                                    <div class="text-center flex items-center justify-center">
                                        <button type="button" class="tooltip text-center text-gray-900 hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                                            </svg>
                                            <span class="tooltiptext text-sm  px-2 py-1.5 text-center text-white absolute bg-gray-800 z-10 border border-white rounded-md">Request</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

        </div>
    </div>
    

    <script src="{{ asset('js/dishes.js') }}" defer></script>
</x-app-layout>
