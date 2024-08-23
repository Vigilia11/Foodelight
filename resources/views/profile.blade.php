<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <div class="py-12 min-h-screen bg-white relative">

        <div id="toast" class="absolute top-5 right-5 hidden">
            <div class="flex items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 border border-gray-100" role="alert">
                
                <div class="ps-4 text-sm font-normal toast-message"></div>
            </div>
        </div>
        <div class="max-w-2xl mx-auto bg-white py-5">
            <div class="w-full mb-3">
                <div class="h-48 w-48 mx-auto bg-white rounded-full mb-2 overflow-hidden">
                    <img src="" alt="" class="w-full h-full profile-picture">
                </div>
                <h1 class="text-center text-2xl font-bold text-black full-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                <h6 class="text-center text-sm text-gray-600 mobile-number">Mobile Number</h6>
            </div>
            <div class="w-full flex justify-center mb-5 gap-2">
                <button type="button" data-modal-target="modal-change-photo" data-modal-toggle="modal-change-photo" class="w-40 py-1 text-sm font-medium border-none text-white bg-violet-600 hover:bg-violet-700 rounded-full tracking-wider">Change Photo</button>
                <button type="button" onclick="editProfile()" class="w-40 py-1 text-sm font-medium border-none text-white bg-blue-600 hover:bg-blue-700 rounded-full tracking-wider">Edit Info</button>
            </div>
            <div class="text-center text-gray-600 text-sm">
                <h6 class="address-1">Street, Barangay</h6>
                <h6 class="address-2">City, Province, Country</h6>
            </div>
        </div>
            
    </div>

    

    

    <!-- change photo -->
    <div id="modal-change-photo" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Change Photo
                    </h3>
                    <button type="button" id="btn-close-modal-change-photo" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-change-photo">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="/updateProfilePhoto" method="post" enctype="multipart/form-data" id="form_update_photo">
                    @csrf
                    <div class="w-full text-center mb-3">
                        <div class="h-52 w-52 bg-white mx-auto rounded-2xl mb-5 overflow-hidden">
                            <img src="" alt="" class="image-preview h-full w-full hidden" id="image_preview">
                        </div>
                        
                        <input type="file" name="photo" id="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" accept="image/*">
                        
                        <span class="text-red-600 text-sm block error photo-error"></span>
                        
                    </div>

                    <div class="w-full">
                        <button type="submit" class="w-full rounded-full py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm tracking-wide">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>     

    <!-- edit info -->
    <button type="button" id="btn-show-modal-edit-info" data-modal-target="modal-edit-info" data-modal-toggle="modal-edit-info" class="hidden w-40 py-1 text-sm font-medium border-none text-white bg-blue-600 hover:bg-blue-700 rounded-full tracking-wider">Show Edit Info Modal</button>

    <div id="modal-edit-info" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit your info
                    </h3>
                    <button type="button" id="btn-close-modal-edit-info" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-edit-info">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form class="space-y-4" action="{{ url('/updateProfileInfo') }}" method="post" id="form_edit_info">
                        @csrf
                        <div>
                            <label for="mobile_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile Number</label>
                            <input type="text" name="mobile_number" id="mobile_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="11" required>
                            <span class="text-sm text-red-600 error mobile_number_error"></span>
                        </div>
                        <div>
                            <label for="street" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street</label>
                            <input type="text" name="street" id="street" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <span class="text-sm text-red-600 error street_error"></span>
                        </div>
                        <div>
                            <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay</label>
                            <input type="text" name="barangay" id="barangay" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <span class="text-sm text-red-600 error barangay_error"></span>
                        </div>
                        <div>
                            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Street</label>
                            <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <span class="text-sm text-red-600 error city_error"></span>
                        </div>
                        
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 


    <!-- script -->
    <script src="{{ asset('js/profile.js') }}" prefer></script>
    <script src="{{ asset('js/profileImagePreview.js') }}" prefer></script>
</x-app-layout>