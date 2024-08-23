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
                            <ul id="price">
                                <li class="text-sm font-medium text-gray-600">
                                    price <span class="text-start  text-lime-600">₱0.00 </span>
                                    <button type="button" class="text-gray-600 hover:text-gray-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    <button type="button" class="text-red-600 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">\
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                            @if(Auth::user()->hasRole('admin'))
                            <button type="button" id="btn-add-price" class="bg-lime-600 hover:bg-lime-500 text-white text-xs px-2 py-1 rounded-sm">Add Price</button>
                            @endif
                        </div>
                        <div class="w-full mt-5">
                            <p class="text-gray-800 text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio doloremque, expedita amet voluptatibus tempora repellendus. Perspiciatis voluptates officia alias similique tempore iure modi fugiat corporis in doloribus? Architecto, itaque fugiat!</p>
                        </div>
                        
                        <div class="w-full mt-8">
                            <div class="w-full grid grid-cols-2 mb-2">
                                <div class="text-sm text-center"><span class="text-md font-medium text-black" id="dish-reacts">100</span> reacts</div>
                                <div class="text-sm text-center"><span class="text-md font-medium text-black" id="dish-request">100</span> request</div>
                            </div>
                            @if(Auth::user()->account_status == "Active")
                                @if(!empty(Auth::user()->profile->id))
                                <div class="w-full grid grid-cols-2 btn-container">
                                    <div>
                                        <button type="button" onclick="showCartModal()" data-modal-target="modal-drink-cart" data-modal-toggle="modal-drink-cart" class="w-full text-md text-center py-4 tracking-widest bg-black text-white" id="btn-cart" value="">ADD TO CART</button>
                                    </div>
                                    <div>
                                        <button type="button" onclick="showOrderModal()" data-modal-target="modal-drink-order" data-modal-toggle="modal-drink-order" class="w-full text-md text-center py-4 tracking-widest bg-lime-600 text-white" id="btn-order" value="">ORDER NOW</button>
                                    </div>
                                </div>`
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
<div id="modal-drink-order" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create order
                </h3>
                <button type="button" id="modal-drink-order-btn-close" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-drink-order">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{ url('/drinkOrder') }}" method="post" id="form_drink_order">
                    @csrf
                    <h1 class="text-2xl font-bold text-black" id="dish_name">Dish</h1>
                    <div class="hidden">
                        <input type="hidden" name="dish_id" id="dish_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                        <select name="size" id="size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" onchange="drinkPriceOrder()">
                            
                        </select>
                        <span class="error size-error text-sm text-red-600 "></span>
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="text" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly>
                        <span class="error price-error text-sm text-red-600 "></span>
                    </div>
                    <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1'); drinkPriceOrder();" required>
                        <span class="error quantity-error text-sm text-red-600 "></span>
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
                              
                </form>
            </div>
        </div>
    </div>
</div> 

<!-- modal dish cart -->
<div id="modal-drink-cart" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create order
                </h3>
                <button type="button" id="modal-drink-cart-btn-close" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-drink-cart">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
            <form class="space-y-4" action="{{ url('/drinkCart') }}" method="post" id="form_drink_cart">
                    @csrf
                    <h1 class="text-2xl font-bold text-black" id="dish_name">Dish</h1>
                    <div class="hidden">
                        <input type="hidden" name="dish_id" id="dish_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div>
                        <label for="size" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Size</label>
                        <select name="size" id="size" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        onchange="drinkPrice()">
                            
                        </select>
                        <span class="error size-error text-sm text-red-600 "></span>
                    </div>
                    <div>
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="text" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly>
                        <span class="error price-error text-sm text-red-600 "></span>
                    </div>
                    <div>
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                        <input type="text" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1'); drinkPrice();" required>
                        <span class="error quantity-error text-sm text-red-600 "></span>
                    </div>                    
                    
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">ADD TO CART</button>
                    <div class="text-center text-sm text-gray-500">Cash on deliver</div>                    
                </form>
            </div>
        </div>
    </div>
</div>

