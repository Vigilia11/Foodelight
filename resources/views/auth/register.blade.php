<x-guest-layout>
    <div class="w-full min-h-screen flex items-center justify-center bg-stone-100">
        <div class="md:w-3/5">
            <div class="">
                <form method="POST" action="{{ route('register') }}" class="">
                    @csrf
                    <div class="mb-2">
                            <h1 class="text-4xl font-medium text-lime-600 text-center">Create Account</h1>
                        </div>
                    <div class="md:shadow-lg relative mb-5">                        
                        <div class="md:grid md:grid-cols-2">
                            <div class="md:p-4 relative bg-white md:h-96">
                                <div class="hidden md:block w-full mb-5">
                                    <div class="w-20 mx-auto text-gray-400 " style="height:87px">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                    </div>
                                </div>
                                <!-- First Name -->
                                <div class="mb-5 space-y-1">
                                    <label for="first_name" class=" text-gray-500">First Name</label>
                                    <input type="text" class="block w-full border border-gray-300 focus:ring-blue-300 focus:border-blue-300 py-1.5 rounded text-gray-700" id="first_name" name="first_name" value="{{old('first_name')}}" required autofocus />
                                    @error('first_name')
                                        <span class="block text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Last Name -->
                                <div class="mb-5 space-y-1">
                                    <label for="last_name" class=" text-gray-500">Last Name</label>
                                    <input type="text" class="block w-full border border-gray-300 focus:ring-blue-300 focus:border-blue-300 py-1.5 rounded text-gray-700" id="last_name" name="last_name" value="{{old('last_name')}}" required autofocus />
                                    @error('last_name')
                                        <span class="block text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="md:p-4 bg-white md:bg-gray-200 relative md:h-96">
                                <!-- Email Address -->
                                <div class="mb-5 space-y-1 mt-5">
                                    <label for="email" class=" md:text-gray-600 text-gray-500">Email</label>
                                    <input type="email" class="block w-full border border-gray-300 focus:ring-blue-300 focus:border-blue-300 py-1.5 rounded text-gray-700" id="email" name="email" value="{{old('email')}}" required autofocus autocomplete="username" />
                                    @error('email')
                                        <span class="block text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-5 space-y-1">
                                    <label for="password" class=" text-gray-500 md:text-gray-600">Password</label>
                                    <input type="password" class="block w-full border border-gray-300 focus:ring-blue-300 focus:border-blue-300 py-1.5 rounded text-gray-700" id="password" name="password" value="{{old('password')}}" required autofocus />
                                    @error('password')
                                        <span class="block text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Confirm Password -->
                                <div class="mb-5 space-y-1">
                                    <label for="password_confirmation" class="  text-gray-500 md:text-gray-600">Confirm Password</label>
                                    <input type="password" class="block w-full border border-gray-300 focus:ring-blue-300 focus:border-blue-300 py-1.5 rounded text-gray-700" id="password_confirmation" name="password_confirmation" required autofocus />
                                    @error('password_confirmation')
                                        <span class="block text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>   
                                <!-- See Password -->
                                <div class="flex ">
                                    <div class="flex items-center">
                                        <div class="flex items-center h-5">
                                            <input id="seePassword" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                                        </div>
                                        <label for="seePassword" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">See Password</label>
                                    </div>
                                </div>                         
                            </div>
                        </div>
                    </div>
                    
                    <div class="w-full flex justify-center">
                        <div class="text-center space-y-2">
                            <button type="submit" class="block bg-black rounded tracking-wider text-white text-sm font-medium text-center w-80 py-1.5">Register</button>
                            <a href="{{ route('login') }}" class="block text-sm font-medium text-gray-800 hover:text-gray-950 hover:underline text-shadow">Already have account?Login</a>
                        </div>                        
                    </div>
                </form>                
            </div>
        </div>
    </div>

    <script src="{{ asset('js/userRegistration.js') }}" prefer></script>
</x-guest-layout>