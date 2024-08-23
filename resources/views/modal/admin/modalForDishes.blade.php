<!-- Main modal -->
<div id="modal-add-dish" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">            
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{ route('dishes.store') }}" method="post" enctype="multipart/form-data" id="add_dish_form">
                    
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <div class="w-full h-full rounded-lg overflow-hidden flex items-center" >
                                <img src="" id="img_dish" class="h-80 w-full hidden" alt="">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full text-gray-500" id="temporary_image">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload image</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" name="image" type="file" accept="image/*" required>
                                <span class="block text-red-500 text-sm image-error error"></span>
                            </div>
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                                <span class="block text-red-500 text-sm name-error error"></span>
                            </div>
                            <div>
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                
                                <input type="text" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="" readonly>
                                
                                <!--
                                <select name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option value="Meal">Meal</option>
                                    <option value="Bread">Bread</option>
                                    <option value="Drink">Drink</option>
                                    <option value="Juice">Juice</option>
                                    <option value="Coffee">Coffee</option>
                                    <option value="Cake">Cake</option>
                                    <option value="Milktea">Milktea</option>
                                </select>
                                -->
                                <span class="block text-red-500 text-sm category-error error"></span>
                            </div>
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="text" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="" required>
                                <span class="block text-red-500 text-sm price-error error"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-5 w-full flex justify-end gap-2">
                        <button type="button" data-modal-hide="modal-add-dish" class="bg-white rounded border border-gray-400 hover:border-gray-500 w-24 py-1.5 text-gray-500 hover:text-gray-600 text-sm font-medium" id="btn_add_dish_hide"
                        onclick="addFormReset();">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white rounded text-center w-24 py-1.5 text-sm font-medium">
                            Add
                        </button>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 
