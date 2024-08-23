<x-app-layout>
    <div class="py-12 min-h-screen bg-white relative">
        <div class="max-w-6xl mx-auto ">
            

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Mobile #
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <img class="w-10 h-10 rounded-full" src="{{ asset('images/profile/'.$user->photo) }}" alt="User's image">
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $user->first_name }} {{ $user->last_name }}</div>
                                    <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                </div>  
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->mobile_number }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->street }} {{ $user->barangay }}, {{ $user->city }}, {{ $user->province }}
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ url('/user/'.$user->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">view</a>
                                <button class="text-red-600 hover:underline font-medium" onclick="deleteUser({{ $user->id }})">delete</button>
                            </td>
                        </tr>
                        @endforeach
                        
                        
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!--modal-->
    <button id="btn-show-modal-delete-user" data-modal-target="modal-delete-user" data-modal-toggle="modal-delete-user" class="hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    Toggle modal
    </button>

    <div id="modal-delete-user" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-delete-user">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                    <form action="{{ url('/deleteUser') }}" method="post" id="form_delete_user">
                        <input type="hidden" name="user_id" id="user_id" value="" >
                        <button data-modal-hide="modal-delete-user" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="modal-delete-user" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin/users.js') }}" defer></script>
</x-app-layout>