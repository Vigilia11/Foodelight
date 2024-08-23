<x-app-layout>
    @include('modal.dishModal')
    <div class="py-2 md:py-12 min-h-screen bg-white relative">
        
        <div id="toast-order" class="absolute top-5 right-5 hidden">
            <div class="flex items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 border border-gray-100" role="alert">
                <img src="{{ asset('images/icons/meal.png') }}" alt="" class="w-8 h-8">
                <div class="ps-4 text-sm font-normal toast-message"></div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto">            
            <div class="px-1 md:px-0">   
                <div class="mb-16">
                    <h1 class="text-gray-800 text-2xl font-bold mb-2">Available Today</h1>
                    <div class="grid grid-flow-row grid-cols-2 md:grid-cols-7 gap-1" id="available_meals">
                        @for($i=1;$i<=10;$i++)
                        <div class="bg-gray-500 h-28 md:h-40 cursor-pointer" onclick="">
                            <img src="" alt="" class="w-full h-full">
                        </div>
                        @endfor
                    </div>
                </div>
                <div class="mb-2 flex justify-center flex-wrap sm:justify-start md:justify-start">
                    <h1 class="block w-full text-center sm:text-start md:text-start text-2xl font-extrabold text-gray-800 mb-2">Meals</h1>
                    @if(Auth::user()->hasRole('admin'))
                    <button data-modal-target="modal-add-dish" data-modal-toggle="modal-add-dish" class="block text-white bg-lime-700 hover:bg-lime-800 font-medium rounded text-sm px-5 py-1.5 -mt-2" type="button">
                        Add Meal
                    </button>
                    @endif
                </div>                
                <div class="w-full flex justify-center mb-5">
                    <div class="space-x-2">
                        <label for="filter" class="text-sm font-medium text-gray-800">Filter by: </label>
                        <select name="filter" id="filter" class="border border-gray-300 text-sm rounded py-1.5" onchange="filter()">
                            <option value="name">Name</option>
                            <option value="price">Price</option>
                            <option value="created_at">Date Added</option>
                        </select>
                    </div>
                </div>
                <div class="md:grid md:grid-flow-row md:grid-cols-4 gap-5" id="meals">
                    @for($i=1;$i<=4;$i++)
                    <div class="bg-white meal-container dish ">
                        <div class="bg-gray-100 h-60 relative overflow-x-visible overflow-y-clip">
                            <div class="hidden absolute top-0 right-0 px-2 py-1 bg-sky-400 available-caption">
                                <span class="text-sm uppercase font-medium text-white">available</span>
                            </div>
                            <div class="absolute bottom-0 left-0 z-10 w-full button-container bg-white">
                                <div class="grid grid-cols-3 w-full">
                                    <button type="button" class="flex justify-center tooltip text-black hover:text-rose-600 py-2 text-center hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                            </svg>
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">React</span>
                                    </button>
                                    <button type="button" class="flex justify-center tooltip text-black hover:text-sky-600 py-2 hover:bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Request</span>
                                    </button>
                                    <button type="button" class="flex justify-center tooltip text-black hover:text-lime-600 py-2 hover:bg-gray-100" data-modal-target="modal-details" data-modal-toggle="modal-details">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Details</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="py-2.5 px-1 relative overflow-x-visible overflow-y-clip">
                            <h6 class="text-black text-lg font-bold">Food</h6>
                            <h6 class="text-start  text-lime-600">₱0.00</h6>
                                
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/user/meals.js') }}" defer></script>
</x-app-layout>
