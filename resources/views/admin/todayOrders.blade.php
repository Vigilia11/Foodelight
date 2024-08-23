<x-app-layout>
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
                <h1 class="text-2xl text-black font-extrabold">Orders</h1>
            </div>
            <div class="flex justify-center w-full mb-5">
                <div class="flex gap-2">
                    <button type="button" class="py-1 w-24 rounded-sm text-sm bg-lime-600 hover:bg-lime-700 focus:bg-black text-white font-medium " onclick="fetchTodayUnnoticedOrders()">Unnotice</button>
                    <button type="button" class="py-1 w-24 rounded-sm text-sm bg-lime-600 hover:bg-lime-700 focus:bg-black text-white font-medium " onclick="fetchTodayNoticedOrders()">Notice</button>
                    <button type="button" class="py-1 w-24 rounded-sm text-sm bg-lime-600 hover:bg-lime-700 focus:bg-black text-white font-medium " onclick="fetchTodayReadyOrders()">Ready</button>
                    <button type="button" class="py-1 w-24 rounded-sm text-sm bg-lime-600 hover:bg-lime-700 focus:bg-black text-white font-medium " onclick="fetchTodayShippingOrders()">Shipping</button>
                    <button type="button" class="py-1 w-24 rounded-sm text-sm bg-lime-600 hover:bg-lime-700 focus:bg-black text-white font-medium " onclick="fetchTodayRecievedOrders()">Received</button>
                </div>
            </div>
            <div class="w-full">
                <span class="hidden">{{ $number = 1; }}</span>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-10">
                    
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Action</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="orders">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> 

    <script src="{{ asset('js/admin/todayOrders.js') }}" defer></script>
</x-app-layout>
