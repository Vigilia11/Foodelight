<!-- user reaction -->
<div id="UserReaction" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Users
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="UserReaction">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="my-4 max-h-96 overflow-y-scroll">
                    @for($i=1;$i<=20;$i++) 
                    <div class="w-full flex items-center gap-2 py-2 hover:bg-gray-100">
                        <div class="h-6 w-6 rounded-full bg-gray-300"></div>
                        <h5 class="text-md font-semibold text-black">Full Name</h5>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>




<!-- modal details -->
<div id="modal-details" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="absolute top-0 right-0">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-details">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-8 space-y-4">
                <div class="grid grid-cols-2 relative">
                    <div class="pr-8">
                        <div class="h-80 bg-gray-300"></div>
                    </div>
                    <div class="relative">
                        <div class="w-full">
                            <h1 class="text-2xl font-bold text-black">Dish Name</h1>
                            <h1 class="text-xl font-medium text-lime-600">25.00</h1>
                        </div>
                        <div class="py-3 w-full">
                            <hr>
                        </div>
                        <div>
                            <p class="text-gray-800 text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio doloremque, expedita amet voluptatibus tempora repellendus. Perspiciatis voluptates officia alias similique tempore iure modi fugiat corporis in doloribus? Architecto, itaque fugiat!</p>
                        </div>
                        <div class="w-full grid grid-cols-2 absolute bottom-0 right-0">
                            <div class="flex items-end">
                                <div class="w-full grid grid-cols-2">
                                    <div class="text-sm text-center"><span class="text-md font-medium text-black">100</span> <br> reacts</div>
                                    <div class="text-sm text-center"><span class="text-md font-medium text-black">100</span> <br> request</div>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="w-full text-sm text-center py-4 tracking-widest bg-lime-600 hover:bg-black text-white">ORDER NOW</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal dish order -->
<div id="modal-dish-order" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create order
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-dish-order">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="#" method="post" id="form_dish_order">
                    <h1 class="text-2xl font-bold text-black">Dish</h1>
                    <div class="hidden">
                        <label for="dish_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                        <input type="text" name="dish_id" id="dish_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="delivery_fee" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                        </div>
                        <label for="remember" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Please add delivery fee when your order arrived.</label>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ORDER NOW</button>
                    <div class="text-center text-sm text-gray-500">Cash on deliver</div>                    
                </form>
            </div>
        </div>
    </div>
</div> 

