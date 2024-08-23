
<!-- Main modal -->
<div id="most-favorites-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-sm max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 overflow-hidden">
            
            <button type="button" class="absolute top-2 right-2 bg-gray-300 text-gray-800 bg-transparent hover:bg-gray-900 hover:text-white rounded-md p-1.5 modal-close-btn" data-modal-hide="most-favorites-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
            </button>
            <!-- Modal body -->
            <div class="">
                <div class="h-60 w-full bg-gray-200">
                    <img src="" alt="" class="w-full h-full modal_dishImage">
                </div>
                <div class="p-2">
                    <h1 class="text-black text-2xl font-bold modal_dishName ">Dish Name</h1>
                    <div class="modal_category text-md font-semibold"></div>                    
                    <h2 class="text-gray-800 text-sm font-medium modal_price">Price</h2>
                </div>
                
                <div class="p-2 border-t border-gray-300 mt-5 bg-white">
                    <div class="grid grid-cols-2">
                        <div class="flex justify-center items-center border-r border-gray-300 modal_button_react gap-2">
                            
                        </div>
                        <div class="flex justify-center items-center modal_button_request gap-2">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
