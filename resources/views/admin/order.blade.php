<x-app-layout>
    @include('modal.message')
    <div class="py-12 min-h-screen bg-white relative">
        <div id="toast-order" class="absolute top-5 right-5 hidden">
            <div class="flex items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 border border-gray-100" role="alert">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-500 rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 17 8 2L9 1 1 19l8-2Zm0 0V9"/>
                </svg>
                <div class="ps-4 text-sm font-normal toast-message"></div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto">            
            <div class="mb-5">
                <h1 class="text-4xl font-bold text-black">Order Items</h1>
            </div>            
            
            <div class="mt-5 space-y-2">
                <div class="">
                    <div class="flex justify-between mb-2">
                        <div class="">
                            <h6 class="text-gray-800 font-medium totalPrice"></h6>
                            <h6 class="text-gray-800 font-medium order-status"></h6>                            
                        </div>                        
                        <div>
                            <h6 class="text-gray-800 font-medium orderDate"></h6>
                            
                        </div>                        
                    </div>
                    <div class="w-full flex items-center gap-2 mb-2" id="order_status">
                        <span class="text-black">Change order status</span>
                        <form action="{{ url('/updateOrder/'.$order_id) }}" method="post" id="form_status_recieved" class="hidden">
                                @csrf
                                @method('put')
                                <input type="hidden" name="status" value="Recieved">
                                <button type="submit" class="px-4 py-1 rounded bg-lime-600 hover:bg-lime-700 text-white text-sm" value="{{ $order_id }}" id="">Recieved</button>
                        </form>
                        <form action="{{ url('/updateOrder/'.$order_id) }}" method="post" id="form_status_ready" class="hidden">
                                @csrf
                                @method('put')
                                <input type="hidden" name="status" value="Ready">
                                <button type="submit" class="px-4 py-1 rounded bg-lime-600 hover:bg-lime-700 text-white text-sm" value="{{ $order_id }}" id="">Ready</button>
                        </form>
                        <form action="{{ url('/updateOrder/'.$order_id) }}" method="post" id="form_status_deliver" class="hidden">
                                @csrf
                                @method('put')
                                <input type="hidden" name="status" value="Shipping">
                                <button type="submit" class="px-4 py-1 rounded bg-lime-600 hover:bg-lime-700 text-white text-sm" value="{{ $order_id }}" id="btn_deliver">Shipping</button>
                        </form>                            
                    </div>
                    <button onclick="showMessage()" class="block bg-white border border-gray-400 text-gray-700 text-sm font-medium tracking-wide px-4 py-1 rounded hover:bg-gray-400 mb-2" type="button">
                        Message
                    </button>
                    <div class="md:grid md:grid-flow-row md:grid-cols-5 md:gap-5" id="orderItems">
                    
                    </div>                    
                </div>
            </div>

        </div>
    </div> 

    <script src="{{ asset('js/admin/orderItems.js') }}" defer></script>
</x-app-layout>
