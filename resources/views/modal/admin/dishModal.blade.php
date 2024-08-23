<button type="button" class="hidden text-black hover:text-lime-600 py-2 hover:bg-gray-100" data-modal-target="modal-details" data-modal-show="modal-details" id="showDetailsModal">details</button>
<!-- modal details -->
<div id="modal-details" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="absolute top-0 right-0">
                <button type="button" id="modalDetails-btn-close" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-details">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-8 space-y-4">
                <div class="md:grid md:grid-cols-2 relative">
                    <div class="md:pr-8 pt-3 md:pt-0">
                        <div class="h-80 bg-gray-300" id="dish-image">
                            
                        </div>
                    </div>
                    <div class="relative">
                        <div class="w-full">
                            <h1 class="text-2xl font-bold text-black" id="dish-name"></h1>
                            <h1 class="text-xl font-medium text-lime-600" id="dish-price"></h1>
                        </div>
                        <div class="w-full mt-5">
                            <p class="text-gray-800 text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio doloremque, expedita amet voluptatibus tempora repellendus. Perspiciatis voluptates officia alias similique tempore iure modi fugiat corporis in doloribus? Architecto, itaque fugiat!</p>
                        </div>
                        <div class="w-full md:absolute md:bottom-0 md:right-0">
                            <div class="w-full grid grid-cols-2 mb-2">
                                <div class="text-sm text-center"><span class="text-md font-medium text-black" id="dish-reacts">100</span> reacts</div>
                                <div class="text-sm text-center"><span class="text-md font-medium text-black" id="dish-request">100</span> request</div>
                            </div>
                            <div class="w-full hidden" id="div_remove_available">
                                <button type="button" id="button_remove_available" onclick="deleteAvailable()" class="bg-gray-800 hover:bg-gray-900 py-1.5 w-full text-white text-sm">Remove from available</button>    
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
