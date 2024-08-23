<x-app-layout>
    <div class="py-12 min-h-screen bg-white relative">
        <div id="toast-order" class="absolute top-5 right-5 hidden">
            <div class="flex items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 border border-gray-100" role="alert">
                
                <div class="ps-4 text-sm font-normal toast-message"></div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto ">
            <div class="flex justify-center">
                <div>
                    <input type="hidden" class="user_id" value="{{ $user_id }}">
                    <img src="" class="w-52 h-52 rounded-full mx-auto profile-photo" alt="">
                    <div class="text-center py-3">
                        <h6 class="text-4xl text-black font-bold tracking-widest name"></h6>
                        <h6 class="text-md  text-gray-800 tracking-wider email"></h6>
                        <h6 class="text-gray-800 mt-5 tracking-wider mobile-number"></h6>
                        <h6 class="text-gray-800 tracking-wider street-barangay"></h6>
                        <h6 class="text-gray-800 tracking-wider city-province"></h6>
                    </div>                    
                </div>                
            </div>
            <div class="flex justify-center gap-4">
                <div>
                    <div class="h-28 w-28 rounded-full border-2 border-lime-900 flex items-center justify-center overflow-hidden">
                        <h6 class="text-gray-600 tracking-wide text-center account-status"></h6>
                    </div>
                    <h6 class="text-sm font-bold text-gray-800 tracking-wide text-center py-1">Account Status</h6>
                </div>
                <div>
                    <div class="h-28 w-28 rounded-full border-2 border-lime-700 flex items-center justify-center overflow-hidden">
                        <h6 class="text-gray-600 tracking-wide text-center total-order"></h6>
                    </div>
                    <h6 class="text-sm font-bold text-gray-800 tracking-wide text-center py-1">Total Order</h6>
                </div>
                <div>
                    <div class="h-28 w-28 rounded-full border-2 border-lime-500 flex items-center justify-center overflow-hidden">
                        <h6 class="text-gray-600 tracking-wide text-center total-order-item"></h6>
                    </div>
                    <h6 class="text-sm font-bold text-gray-800 tracking-wide text-center py-1">Total Order Item</h6>
                </div>
                <div>
                    <div class="h-28 w-28 rounded-full border-2 border-lime-300 flex items-center justify-center overflow-hidden">
                        <h6 class="text-gray-600 tracking-wide text-center spent"></h6>
                    </div>
                    <h6 class="text-sm font-bold text-gray-800 tracking-wide text-center py-1">Spent</h6>
                </div>
            </div>
            <div class="flex justify-center mt-5">
            <button type="button" class="bg-gray-800 hover:bg-gray-950 py-2 w-60 text-white tracking-wider text-sm btn-block-account hidden"
                data-modal-target="modal-block-user" data-modal-toggle="modal-block-user">Block User</button>
            <button type="button" onclick="setUserActive()" class="bg-lime-700 hover:bg-lime-800 py-2 w-60 text-white tracking-wider text-sm btn-set-active hidden">Set User Active</button>
            </div>
            
        </div>
    </div>

    <!--modal-->
    <div id="modal-block-user" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button id="btn-close-modal-block-user" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-block-user">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to block this account?</h3>
                    <!--
                    <form action="{{ url('/blockUser/'.$user_id) }}" method="post" id="form_block_user">
                        @csrf
                        @method('PUT')
                        <input type="hidden" class="" name="account_status" value="Blocked">
                        <button type="submit" class="text-white bg-gray-950 hover:bg-black focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="modal-block-user" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </form>
-->
                        <button type="button" onclick="blockUser()" class="text-white bg-gray-950 hover:bg-black focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="modal-block-user" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin/user.js') }}" defer></script>
</x-app-layout>