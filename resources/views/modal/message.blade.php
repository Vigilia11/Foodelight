<link rel="stylesheet" href="{{ asset('css/message.css') }}">

<!-- Modal toggle -->
<button id="btn-show-modal-message" data-modal-target="modal-message" data-modal-toggle="modal-message" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button>

<!-- Main modal -->
<div id="modal-message" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" id="modal-content">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Messages
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-message">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4 ">
                <div class="w-full messages space-y-2">                    
                    <div class="flex items-start gap-2.5 justify-start">
                        <img src="" class="w-8 h-8" alt="">
                        <div class="flex flex-col w-full max-w-[320px] leading-1.5">
                            <div class="flex items-center space-x-2 rtl:space-x-reverse justify-start">
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">Full Name</span>
                            </div>
                            <p class="text-sm font-normal p-2 text-gray-900 dark:text-white bg-gray-100 text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nobis nam, qui voluptas a, commodi aliquid magni odio hic totam laboriosam optio corporis pariatur similique ratione expedita adipisci fugiat dolorum?</p>
                            <div class="space-x-5 text-start">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">message.status</span>
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">message.created_at</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal footer -->
            <div class="p-5 border-t border-gray-200" id="message-bottom">
                <form action="{{ url('/sendMessage') }}" method="post" class="" id="form_send_message" class="">
                    @csrf
                    <div class="flex border border-gray-300 rounded-full overflow-hidden">
                        <input type="hidden" name="order_id" id="order_id" class="" value="{{ $order_id }}">
                        <textarea name="message"  placeholder="Write message" id="message"
                            oninput="auto_grow(this)" 
                            class="message py-2 px-3 border border-transparent focus:border-transparent outline outline-transparent focus:outline-transparent ring ring-transparent focus:ring-transparent  block flex-1 min-w-0 overflow-hidden text-gray-700" required></textarea>
                        <div class="flex items-center">
                            <button type="submit" class="p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 stroke-gray-500 hover:stroke-gray-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <span class="text-red-600 text-sm error message-error"></span>
                </form>
            </div>
        </div>
    </div>
</div>
