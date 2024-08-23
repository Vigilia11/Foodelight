

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
                            @if(Auth::user()->account_status == "Active")
                                @if(!empty(Auth::user()->profile->id))
                                <div class="w-full grid grid-cols-2 btn-container">
                                    <div>
                                        <button type="button" onclick="showCartModal()" data-modal-target="modal-dish-cart" data-modal-toggle="modal-dish-cart" class="w-full text-md text-center py-4 tracking-widest bg-black text-white" id="btn-cart" value="">ADD TO CART</button>
                                    </div>
                                    <div>
                                        <button type="button" onclick="showOrderModal()" data-modal-target="modal-dish-order" data-modal-toggle="modal-dish-order" class="w-full text-md text-center py-4 tracking-widest bg-lime-600 text-white" id="btn-order" value="">ORDER NOW</button>
                                    </div>
                                </div>
                                @else
                                <div class="text-sm text-black bg-indigo-200 px-2 py-2 tracking-wide">
                                    Please fillup your profile info to make an order. <a href="{{ url('/profile') }}" class="text-blue-600 hover:underline">Click here</a>
                                </div>
                                @endif
                            @endif
                            
                        </div>
                        
                    </div>
                </div>
                @if(Auth::user()->account_status == "Blocked")
                    <div class="text-sm text-black bg-red-200 px-2 py-2 tracking-wide">
                        You commit a violation with your order. As our response, the admin blocked your account.
                        You can no longer add your item to cart and cannot order your dishes from the system.
                        Please visit us if you want to unblocked your account.
                    </div>
                @endif
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
                <button type="button" id="modal-dish-order-btn-close" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-dish-order">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{ url('/dishOrder') }}" method="post" id="form_dish_order">
                    @csrf
                    <h1 class="text-2xl font-bold text-black" id="dish_name">Dish</h1>
                    <div class="hidden">
                        <input type="text" name="dish_id" id="dish_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="text" name="price" id="price" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" readonly>
                    </div>
                    <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1'); dishPriceOrder();" required>
                    </div>
                    <div>                        
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recieve Method</label>
                        
                        <div class="flex">
                            <div class="flex items-center me-4">
                                <input id="Pickup" type="radio" value="Pickup" name="recieve_method" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required>
                                <label for="Pickup" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pickup</label>
                            </div>
                            <div class="flex items-center me-4">
                                <input id="Shipping" type="radio" value="Shipping" name="recieve_method" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required>
                                <label for="Shipping" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Shipping</label>
                            </div>
                        </div>

                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="delivery_fee" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                        </div>
                        <label for="delivery_fee" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Please add delivery fee if you choose Shipping.</label>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ORDER NOW</button>
                    <div class="text-center text-sm text-gray-500">Cash on deliver</div>                    
                </form>
            </div>
        </div>
    </div>
</div> 

<!-- modal dish cart -->
<div id="modal-dish-cart" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create cart
                </h3>
                <button type="button" id="modal-dish-cart-btn-close" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-dish-cart">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{ url('/dishCart') }}" method="post" id="form_dish_cart">
                    @csrf
                    <h1 class="text-2xl font-bold text-black" id="dish_name">Dish</h1>
                    <div class="hidden">
                        <input type="text" name="dish_id" id="dish_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        <input type="text" name="size_id" id="size_id" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" readonly>
                    </div>
                    <div class="">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="text" name="price" id="price" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" readonly>
                    </div>
                    <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1'); dishPriceCart();" 
                        value="1" required>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ADD TO CART</button>
                                    
                </form>
            </div>
        </div>
    </div>
</div>

